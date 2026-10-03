# 🏠 ProDesk — Your Properties. One Digital Showroom.

ProDesk is a Laravel-based property management platform built for real-estate dealers. It lets a dealer list properties, manage photos and videos, and present everything from one clean digital showroom instead of scattered WhatsApp images and notebooks.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=flat&logo=alpinedotjs&logoColor=black)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=flat&logo=bootstrap&logoColor=white)
![Status](https://img.shields.io/badge/status-in%20development-C9A227)

---

## 📸 Screenshots

> Add screenshots here (dashboard, properties list, property details, edit page, mobile view).

| Dashboard | Properties | Property Details |
|-----------|------------|------------------|
| _screenshot_ | _screenshot_ | _screenshot_ |

---

## ✨ Features

**Available now**
- 🔐 Authentication (register, login, logout) using Laravel Breeze
- 🏘️ Property CRUD: add, view, edit and delete listings
- 🛡️ Ownership-based authorization: a dealer can only manage their own properties
- 🖼️ Property media: upload photos and videos, delete them, and choose a cover photo
- 📋 Property listing page and detailed property page
- 📊 Basic dashboard

**In progress**
- 🎨 Full UI redesign into a premium SaaS look: desktop sidebar, mobile bottom navigation, new login/register, properties and details pages

**Planned**
- Better multi-media upload
- Client management
- Client presentation mode with shareable links
- Maps and analytics
- Multi-dealer SaaS architecture
- Flutter mobile app

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel, PHP |
| Database | MySQL |
| Frontend | Blade, Bootstrap 5, Alpine.js |
| Auth | Laravel Breeze |
| Build tool | Vite |
| Testing | Pest |
| Local environment | XAMPP |

---

## 🚀 Getting Started

### Prerequisites
- PHP and Composer
- Node.js and npm
- MySQL (XAMPP works fine)

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/aryanaswal3-source/ProDesk.git
cd ProDesk

# 2. Install dependencies
composer install
npm install

# 3. Set up environment
cp .env.example .env
php artisan key:generate
```

Open `.env` and set your database details:

```env
DB_DATABASE=prodesk
DB_USERNAME=root
DB_PASSWORD=
```

Create an empty database named `prodesk` in phpMyAdmin, then run:

```bash
# 4. Run migrations and link storage (needed for property photos/videos)
php artisan migrate
php artisan storage:link

# 5. Start the app
npm run dev
php artisan serve
```

Visit **http://127.0.0.1:8000** in your browser.

### Run tests

```bash
php artisan test
```

---

## 🎨 Brand Colors

| Color | Hex |
|-------|-----|
| Deep Green | `#12372A` |
| Gold | `#C9A227` |
| Warm Off-White | `#F7F5EF` |
| Charcoal | `#202522` |

---

## 🗺️ Roadmap

- [x] Authentication
- [x] Property CRUD and ownership authorization
- [x] Photo/video upload with cover photo
- [ ] Premium UI redesign (in progress)
- [ ] Client management
- [ ] Client presentation mode with shareable links
- [ ] Maps and analytics
- [ ] Multi-dealer SaaS support
- [ ] Flutter mobile app

---

## 👨‍💻 Author

**Aryan Aswal**
- GitHub: [@aryanaswal3-source](https://github.com/aryanaswal3-source)
- LinkedIn: [aryan-aswal](https://www.linkedin.com/in/aryan-aswal-0074612a2)
- Email: aryanaswal3@gmail.com

---

⭐ If you find this project useful, consider giving it a star!
