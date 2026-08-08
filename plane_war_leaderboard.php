<?php
/**
 * 飞机大战排行榜 API
 * 每次游戏结束都记录一条新数据
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once 'config.php';

class LeaderboardAPI {
    private $pdo;
    private $maxRankings = 100;
    
    public function __construct() {
        try {
            $this->pdo = getDBConnection();
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            $this->errorResponse('数据库连接失败: ' . $e->getMessage());
        }
    }
    
    public function handleRequest() {
        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
        
        switch ($action) {
            case 'submit':
                $this->submitScore();
                break;
            case 'get':
                $this->getLeaderboard();
                break;
            case 'get_player':
                $this->getPlayerInfo();
                break;
            case 'clear':
                $this->clearLeaderboard();
                break;
            default:
                $this->getLeaderboard();
        }
    }
    
    /**
     * 提交成绩 - 每次插入新记录
     */
    private function submitScore() {
        try {
            // 获取参数
            $playerName = isset($_REQUEST['player_name']) ? trim($_REQUEST['player_name']) : '';
            $score = isset($_REQUEST['score']) ? intval($_REQUEST['score']) : 0;
            $level = isset($_REQUEST['level']) ? intval($_REQUEST['level']) : 1;
            
            // 验证参数
            if (empty($playerName)) {
                $this->errorResponse('玩家名称不能为空');
            }
            if (strlen($playerName) > 50) {
                $this->errorResponse('玩家名称不能超过50个字符');
            }
            if ($score < 0) {
                $this->errorResponse('分数不能为负数');
            }
            if ($level < 1) {
                $this->errorResponse('关卡数必须大于0');
            }
            
            // ★ 修改：直接插入新记录，不再更新已有记录
            $insertStmt = $this->pdo->prepare("
                INSERT INTO plane_war_leaderboard 
                (player_name, score, level, create_time, update_time)
                VALUES (?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
            ");
            $insertStmt->execute([$playerName, $score, $level]);
            
            // 获取新插入的ID
            $newId = $this->pdo->lastInsertId();
            
            // 获取排名
            $rank = $this->getPlayerRank($newId);
            
            $this->successResponse([
                'action' => 'insert',
                'id' => $newId,
                'player_name' => $playerName,
                'score' => $score,
                'level' => $level,
                'rank' => $rank,
                'message' => '✅ 成绩已保存！'
            ]);
            
        } catch (PDOException $e) {
            $this->errorResponse('数据库错误: ' . $e->getMessage());
        }
    }
    
    /**
     * 获取排行榜（按分数降序）
     */
    private function getLeaderboard() {
        try {
            $limit = isset($_REQUEST['limit']) ? intval($_REQUEST['limit']) : 10;
            $offset = isset($_REQUEST['offset']) ? intval($_REQUEST['offset']) : 0;
            $playerName = isset($_REQUEST['player_name']) ? trim($_REQUEST['player_name']) : '';
            
            if ($limit > 100) $limit = 100;
            if ($limit < 1) $limit = 10;
            if ($offset < 0) $offset = 0;
            
            $sql = "SELECT 
                        id, 
                        player_name, 
                        score, 
                        level, 
                        DATE_FORMAT(create_time, '%Y-%m-%d %H:%i') as create_time,
                        DATE_FORMAT(update_time, '%Y-%m-%d %H:%i') as update_time
                    FROM plane_war_leaderboard 
                    ORDER BY score DESC, create_time ASC";
            
            // 如果指定了玩家名称，查询该玩家的所有记录
            if (!empty($playerName)) {
                $stmt = $this->pdo->prepare($sql . " WHERE player_name = ?");
                $stmt->execute([$playerName]);
                $playerRecords = $stmt->fetchAll();
                
                if ($playerRecords) {
                    // 获取该玩家的最佳排名
                    $rank = $this->getPlayerBestRank($playerName);
                    $this->successResponse([
                        'player' => $playerRecords,
                        'best_rank' => $rank,
                        'total_records' => count($playerRecords)
                    ]);
                } else {
                    $this->errorResponse('未找到该玩家的记录', 404);
                }
                return;
            }
            
            // 获取排行榜列表
            $stmt = $this->pdo->prepare($sql . " LIMIT ? OFFSET ?");
            $stmt->execute([$limit, $offset]);
            $rankings = $stmt->fetchAll();
            
            // 添加排名
            foreach ($rankings as $index => &$record) {
                $record['rank'] = $offset + $index + 1;
            }
            
            // 获取总记录数
            $countStmt = $this->pdo->query("SELECT COUNT(*) as total FROM plane_war_leaderboard");
            $total = $countStmt->fetch()['total'];
            
            $this->successResponse([
                'rankings' => $rankings,
                'total' => intval($total),
                'limit' => $limit,
                'offset' => $offset
            ]);
            
        } catch (PDOException $e) {
            $this->errorResponse('数据库错误: ' . $e->getMessage());
        }
    }
    
    /**
     * 获取玩家信息（所有记录）
     */
    private function getPlayerInfo() {
        try {
            $playerName = isset($_REQUEST['player_name']) ? trim($_REQUEST['player_name']) : '';
            
            if (empty($playerName)) {
                $this->errorResponse('请提供玩家名称');
            }
            
            $stmt = $this->pdo->prepare("
                SELECT 
                    id, 
                    player_name, 
                    score, 
                    level,
                    DATE_FORMAT(create_time, '%Y-%m-%d %H:%i') as create_time,
                    DATE_FORMAT(update_time, '%Y-%m-%d %H:%i') as update_time
                FROM plane_war_leaderboard 
                WHERE player_name = ?
                ORDER BY score DESC, create_time ASC
            ");
            $stmt->execute([$playerName]);
            $records = $stmt->fetchAll();
            
            if (!$records) {
                $this->successResponse([
                    'exists' => false,
                    'message' => '该玩家尚未创建记录'
                ]);
                return;
            }
            
            // 计算统计信息
            $totalRecords = count($records);
            $bestScore = $records[0]['score'];
            $bestLevel = $records[0]['level'];
            $avgScore = 0;
            foreach ($records as $r) {
                $avgScore += $r['score'];
            }
            $avgScore = round($avgScore / $totalRecords);
            
            // 获取最佳排名
            $bestRank = $this->getPlayerBestRank($playerName);
            
            $this->successResponse([
                'exists' => true,
                'player_name' => $playerName,
                'records' => $records,
                'total_records' => $totalRecords,
                'best_score' => intval($bestScore),
                'best_level' => intval($bestLevel),
                'avg_score' => intval($avgScore),
                'best_rank' => $bestRank
            ]);
            
        } catch (PDOException $e) {
            $this->errorResponse('数据库错误: ' . $e->getMessage());
        }
    }
    
    /**
     * 获取指定记录的排名
     */
    private function getPlayerRank($recordId) {
        try {
            // 先获取该记录的分数
            $stmt = $this->pdo->prepare("SELECT score FROM plane_war_leaderboard WHERE id = ?");
            $stmt->execute([$recordId]);
            $result = $stmt->fetch();
            if (!$result) return null;
            
            $score = $result['score'];
            
            // 计算排名（分数比他高的数量 + 1）
            $stmt = $this->pdo->prepare("
                SELECT COUNT(*) + 1 as rank 
                FROM plane_war_leaderboard 
                WHERE score > ?
            ");
            $stmt->execute([$score]);
            $rankResult = $stmt->fetch();
            return $rankResult ? intval($rankResult['rank']) : 1;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    /**
     * 获取玩家的最佳排名
     */
    private function getPlayerBestRank($playerName) {
        try {
            // 获取该玩家的最高分
            $stmt = $this->pdo->prepare("
                SELECT MAX(score) as max_score FROM plane_war_leaderboard WHERE player_name = ?
            ");
            $stmt->execute([$playerName]);
            $result = $stmt->fetch();
            if (!$result || !$result['max_score']) return null;
            
            $maxScore = $result['max_score'];
            
            // 计算排名
            $stmt = $this->pdo->prepare("
                SELECT COUNT(DISTINCT score) + 1 as rank 
                FROM plane_war_leaderboard 
                WHERE score > ?
            ");
            $stmt->execute([$maxScore]);
            $rankResult = $stmt->fetch();
            return $rankResult ? intval($rankResult['rank']) : 1;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    /**
     * 清除排行榜
     */
    private function clearLeaderboard() {
        try {
            $confirm = isset($_REQUEST['confirm']) ? $_REQUEST['confirm'] : '';
            
            if ($confirm !== 'yes') {
                $this->errorResponse('请确认清除操作: confirm=yes');
            }
            
            $stmt = $this->pdo->prepare("TRUNCATE TABLE plane_war_leaderboard");
            $stmt->execute();
            
            $this->successResponse([
                'message' => '排行榜已清除'
            ]);
            
        } catch (PDOException $e) {
            $this->errorResponse('数据库错误: ' . $e->getMessage());
        }
    }
    
    /**
     * 成功响应
     */
    private function successResponse($data) {
        echo json_encode([
            'success' => true,
            'code' => 200,
            'data' => $data
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    /**
     * 错误响应
     */
    private function errorResponse($message, $code = 400) {
        http_response_code($code);
        echo json_encode([
            'success' => false,
            'code' => $code,
            'message' => $message
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// 执行API
$api = new LeaderboardAPI();
$api->handleRequest();
?>