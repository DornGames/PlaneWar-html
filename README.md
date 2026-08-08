# Donh Space War Simulator

---

## About the Game

**Donh Space War Simulator** is a complete shoot 'em up game built with HTML5, Canvas, and vanilla JavaScript. It is a **HTML/CSS/JavaScript reset** of the original C++ project **[Plane War](https://github.com/DornGames/PlaneWar)** . Take control of your fighter jet, shoot down waves of enemy aircraft, collect power-ups, defeat bosses, and climb the online leaderboard. All graphics are rendered using the Canvas 2D API, delivering a nostalgic arcade experience with smooth 60 FPS gameplay.

---

### Features

| Category | Features |
| :--- | :--- |
| 🎮 **Game States** | Main Menu → Playing → Paused (with Codex / Equipment / Shop / Skill panels) → Game Over / Settlement |
| ✈️ **Player System** | WASD/Arrow key movement, lives (upgradeable), invincibility after hit, engine flame animation |
| 🔫 **Firepower System** | 4 weapon types: 瓜摊号 / 自然空间号 / 总统号 / 终极引力号, each with 3 upgrade levels |
| 👾 **Enemy System** | 7 enemy types: 玫瑰号 / 小王子号 / 镁条号 / 飞蛾号 / 装甲机 / 柯伊伯号 / 奥尔特号, each with unique movement and attack patterns |
| 👹 **Boss Battles** | One boss per level: 鸡家军 / 钛镁军 / 八𣿅军, with health bar and multiple attack patterns |
| 💊 **Item System** | 4 temporary items (Fire Up / Heal / Shield / Bomb) + 2 permanent rare items (Max Life / Power Up) + Equipment drops |
| 💥 **Visual Effects** | Explosion particles, hit flash, screen shake, laser ultimate, shield aura, parallax scrolling starfield |
| 📊 **HUD** | Score, lives, level, firepower level, bomb count, energy bar (ultimate), experience bar |
| 🏆 **Leaderboard** | Online backend storage (PHP + MySQL), top records with player names |
| 📖 **Enemy Codex** | Press I while paused to view player stats and enemy data for current level |
| 🛒 **Shop System** | Purchase ultimates and skills using in-game currency |
| ⚙️ **Equipment System** | Collect, equip, fuse and upgrade gear (Weapon / Armor / Engine) |

---

### Controls

| Key | Action |
| :--- | :--- |
| `W` `A` `S` `D` / `↑` `←` `↓` `→` | Move aircraft (8-directional) |
| `Space` | Auto-fire (hold down) |
| `X` | Release ultimate (requires full energy) |
| `R` | Parry (reflect enemy bullets back) |
| `B` | Use skill (bomb / heal / shield / etc.) |
| `P` | Pause / Resume |
| `I` | Toggle Codex Panel (while paused) |
| `E` | Toggle Equipment Panel (while paused) |
| `S` | Toggle Shop Panel (while paused) |
| `K` | Toggle Skill Panel (while paused) |
| `M` | Toggle mute |
| `F3` | Toggle FPS display |
| `Enter` / `Space` | Start game / Return to menu (on result screens) |
| `ESC` | Return to main menu / Quit game / Settle and exit |

---

### Tech Stack

- **Language:** JavaScript (ES6+)
- **Graphics:** HTML5 Canvas 2D API
- **Backend:** PHP + MySQL (for leaderboard)
- **Audio:** HTML5 Web Audio API, supports `.mp3` playback
- **Rendering:** Double-buffered batch drawing, 60 FPS target
- **Deployment:** Static HTML page, no build tools required

---

### Audio Credits

| File | License | Copyright |
| :--- | :--- | :--- |
| `bgm_menu.mp3` | **CC BY-NC-ND 4.0** | DornGames (Private) |
| `bgm_boss.mp3` | All rights reserved | Original Author |
| `bgm_playing.mp3` | All rights reserved | Original Author |
| `bgm_pause.mp3` | All rights reserved | Original Author |

> **Note:** `bgm_menu.mp3` is proprietary audio created by DornGames and is licensed under the **Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License**. You may not use it for commercial purposes, modify it, or distribute it without proper attribution.

---

### Download & Play

> The game runs directly in your browser — no installation required!

1. Visit the game page: [Donh Space War Simulator](https://dornhub.eu.org/games/plane-war/plane-war.html)
2. The game loads instantly in your browser
3. Press `Enter` or `Space` to start

No downloads, no installations, no plugins — just open your browser and play!

---

### Build from Source

**Prerequisites:**
- A modern web browser (Chrome, Firefox, Edge, or Safari)
- A text editor (VS Code, Sublime Text, etc.)
- (Optional) A web server for local testing (e.g., VS Code Live Server, Python `http.server`)

**Steps:**
1. Clone this repository
2. Open the `.html` file in your browser directly, or serve it with a local web server
3. All assets (audio files, images) are loaded from the same directory
4. The leaderboard backend requires PHP + MySQL hosting (configured separately)

---

### Team & Copyright

**Sub-Team:** DornGames  
**Copyright © 2023-2026 DornGames. All Rights Reserved.**

**Parent Team:** Dorn Hub  
**Copyright © 2021-2026 Dorn Hub. All Rights Reserved.**

---

### License

This project is licensed under the **AGPL-3.0 License** — a strong copyleft license that requires any modified versions of the software to be released under the same license, and that the source code be made available to users when the software is run over a network.  
`bgm-menu.mp3` is owned privately by us and is licensed under the **CC BY-NC-ND 4.0** license.

**Copyright © 2026 DornGames / Dorn Hub**

---

A toast with Prickly Pear juice!🍹  
DornGames & Dorn Hub

---

# 𣿅国太空大战模拟器

---

## 关于游戏

**《𣿅国太空大战模拟器》** 是一款基于 HTML5 Canvas 和纯 JavaScript 开发的完整飞行射击游戏。它是原 C++ 项目 **[Plane War](https://github.com/DornGames/PlaneWar)** 的 **HTML/CSS/JavaScript 重置版**。操控你的战机，击落一波波敌机，收集道具强化自身，击败每关的 Boss，冲击在线排行榜。所有图形均使用 Canvas 2D API 渲染，带来流畅 60 FPS 的复古街机体验。

---

### 功能特性

| 类别 | 功能 |
| :--- | :--- |
| 🎮 **游戏状态** | 主菜单 → 游戏进行 → 暂停（含图鉴 / 装备 / 商店 / 技能面板）→ 失败 / 结算 |
| ✈️ **玩家系统** | WASD/方向键移动、生命值（可升级）、受击无敌闪烁、引擎尾焰动画 |
| 🔫 **火力系统** | 4 种武器类型：瓜摊号 / 自然空间号 / 总统号 / 终极引力号，每种 3 级火力升级 |
| 👾 **敌机系统** | 7 种敌机：玫瑰号 / 小王子号 / 镁条号 / 飞蛾号 / 装甲机 / 柯伊伯号 / 奥尔特号，各有独特移动与攻击模式 |
| 👹 **Boss 战** | 每关一位 Boss（鸡家军 / 钛镁军 / 八𣿅军），带独立血条，多种弹幕招式 |
| 💊 **道具系统** | 4 种临时道具（火力增强 / 回血 / 护盾 / 炸弹）+ 2 种永久稀有道具（生命上限 / 攻击力提升）+ 装备掉落 |
| 💥 **视觉效果** | 爆炸粒子、受击白闪、屏幕震动、激光大招、护盾光环、视差滚动星空背景 |
| 📊 **HUD 界面** | 分数、生命、关卡、火力等级、炸弹数量、能量条（大招）、经验条 |
| 🏆 **排行榜** | 后端数据库存储（PHP + MySQL），记录玩家历史成绩 |
| 📖 **敌机图鉴** | 暂停时按 I 键打开，查看我方属性与当前关卡敌机详细数据 |
| 🛒 **军火采购** | 使用游戏货币购买大招和小技能 |
| ⚙️ **装备系统** | 收集、装备、合成、升级装备（武器 / 护甲 / 引擎） |

---

### 操作说明

| 按键 | 功能 |
| :--- | :--- |
| `W` `A` `S` `D` / `↑` `←` `↓` `→` | 移动战机（支持八方向） |
| `空格` | 自动连射（按住即可） |
| `X` | 释放大招（需能量集满） |
| `R` | 弹反（反弹敌方子弹） |
| `B` | 使用技能（炸弹 / 回血 / 护盾 等） |
| `P` | 暂停 / 继续游戏 |
| `I` | 暂停时打开/关闭图鉴面板 |
| `E` | 暂停时打开/关闭装备面板 |
| `S` | 暂停时打开/关闭军火采购面板 |
| `K` | 暂停时打开/关闭技能面板 |
| `M` | 静音切换 |
| `F3` | 显示/隐藏 FPS |
| `回车` / `空格` | 开始游戏 / 结算界面返回菜单 |
| `ESC` | 返回主菜单 / 退出游戏 / 结算退出 |

---

### 技术栈

- **编程语言：** JavaScript（ES6+）
- **图形渲染：** HTML5 Canvas 2D API
- **后端：** PHP + MySQL（排行榜）
- **音频：** HTML5 Web Audio API，支持 `.mp3` 播放
- **渲染方式：** 双缓冲批量绘制，60 FPS 目标
- **部署方式：** 静态 HTML 页面，无需构建工具

---

### 音频版权声明

| 文件 | 许可证 | 版权归属 |
| :--- | :--- | :--- |
| `bgm_menu.mp3` | **CC BY-NC-ND 4.0** | DornGames（私有） |
| `bgm_boss.mp3` | 保留所有权利 | 原作者 |
| `bgm_playing.mp3` | 保留所有权利 | 原作者 |
| `bgm_pause.mp3` | 保留所有权利 | 原作者 |

> **注意：** `bgm_menu.mp3` 是 DornGames 创作的专有音频，采用 **CC BY-NC-ND 4.0** 授权。未经适当署名，您不得将其用于商业目的、修改或分发。

---

### 下载与运行

> 游戏直接在浏览器中运行，无需安装！

1. 访问游戏页面：[𣿅国太空大战模拟器](https://dornhub.eu.org/games/plane-war/plane-war.html)
2. 游戏在浏览器中即刻加载
3. 按 `回车` 或 `空格` 开始游戏

无需下载、无需安装、无需插件 —— 打开浏览器即可游玩！

---

### 从源码构建

**前置条件：**
- 现代网页浏览器（Chrome、Firefox、Edge 或 Safari）
- 文本编辑器（VS Code、Sublime Text 等）
- （可选）本地测试用的 Web 服务器（如 VS Code Live Server、Python `http.server`）

**构建步骤：**
1. 克隆本仓库到本地
2. 直接在浏览器中打开 `.html` 文件，或使用本地 Web 服务器托管
3. 所有资源（音频文件、图片）从同目录加载
4. 排行榜后端需要单独配置 PHP + MySQL 环境

---

### 团队与版权

**子团队：** DornGames  
**Copyright © 2023-2026 DornGames. All Rights Reserved.**

**母团队：** Dorn Hub  
**Copyright © 2021-2026 Dorn Hub. All Rights Reserved.**

---

### 许可证

本项目采用 **AGPL-3.0 许可证** —— 一个强 Copyleft 协议，要求修改后的软件版本必须以相同许可证发布，并且当软件通过网络运行时，必须向用户提供源代码。  
`bgm_menu.mp3`的版权为私有，采用 **CC BY-NC-ND 4.0** 许可证。

**Copyright © 2026 DornGames / Dorn Hub**

---

*最后更新：2026年8月8日*

---

敬上一杯刺梨汁！🍹  
DornGames & Dorn Hub
