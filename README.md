# 🦅 X-Ample Development - Custom Pterodactyl Panel

[![MIT License](https://img.shields.io/github/license/X-AmpleDevelopment/panel?style=flat-square)](LICENSE)
[![Stars](https://img.shields.io/github/stars/X-AmpleDevelopment/panel?style=flat-square)](https://github.com/X-AmpleDevelopment/panel/stargazers)
[![Forks](https://img.shields.io/github/forks/X-AmpleDevelopment/panel?style=flat-square)](https://github.com/X-AmpleDevelopment/panel/network/members)
[![Latest Release](https://img.shields.io/github/v/release/X-AmpleDevelopment/panel?style=flat-square)](https://github.com/X-AmpleDevelopment/panel/releases)

A modern, optimized fork of the [Pterodactyl Panel](https://github.com/pterodactyl/panel), customized and maintained by **X-Ample Development**.  
This version integrates enhanced backend tooling with [**Blueprint**](https://blueprint.zip/) and a stunning UI overhaul via the [**Premium Nebula Theme**](https://builtbybit.com/resources/nebula.32442/).

---

## 🧩 What's Included

### 🔧 Backend Enhancements — Blueprint
- Optimized Laravel structure
- Improved permission scaffolding
- Streamlined service and controller layers
- Easier customization and extension points

### 🌌 Frontend Overhaul — Nebula Premium Theme
- Sleek and modern UI/UX
- Fully responsive layout
- Extended panel settings interface
- Custom user dashboard widgets
- Professionally designed dark theme
- Integrated icons and layout refinements

> 💡 *Note: Nebula is a premium product. You must have a valid license to use it from [BuiltByBit](https://builtbybit.com/resources/nebula.32442/).*

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/X-AmpleDevelopment/panel.git
cd panel
```

### 2. Install Dependencies
```bash
Copy
Edit
cp .env.example .env
composer install --no-dev --optimize-autoloader
php artisan key:generate
npm install
npm run build
```
### 3. Database Setup
```bash
Copy
Edit
php artisan migrate --seed
```
###4. Set Permissions
```bash
Copy
Edit
chown -R www-data:www-data *
chmod -R 755 storage bootstrap/cache
```
### 🎨 Custom Features by X-Ample
Refactored file & structure management

Enhanced system overview UI

Live server resource stats with auto-refresh

Optimized license integration system

Integrated X-Ample Support tools

Pre-configured theme and plugin slots

### 🔐 License
This project is licensed under the MIT License — see the LICENSE file for details.

⚠️ Note: Nebula Theme is licensed separately and not included in this repository. You must purchase it from BuiltByBit to legally use it.

🌐 Connect With Us
🌍 [Website](https://x-ampledevelopment.co.uk)
🛠  [Discord](https://discord.gg/bGhguE93Xp)

### 💬 Credits
[Pterodactyl Panel](https://github.com/pterodactyl/panel) – Original Panel

Blueprint – Backend Structure

Nebula Theme – Frontend UI

X-Ample Development – Customization and Support
