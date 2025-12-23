# ⚡ Quick Start Guide

**Ingin langsung jalankan project? Ikuti 3 langkah ini!**

---

## 🚀 Setup (5 Menit)

### 1️⃣ Install Dependencies
```powershell
cd digital-time-capsule
composer install
npm install
```

### 2️⃣ Setup Environment
```powershell
copy .env.example .env
php artisan key:generate
```

Edit `.env` — ganti:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=digital_time_capsule
DB_USERNAME=root
DB_PASSWORD=
```

### 3️⃣ Database Setup
Buat database (phpMyAdmin atau terminal):
```powershell
mysql -u root -e "CREATE DATABASE digital_time_capsule CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Jalankan migrations:
```powershell
php artisan migrate:fresh --seed
php artisan storage:link
```

---

## 🌐 Jalankan Project

**Terminal 1 — Asset Compilation:**
```powershell
npm run dev
```

**Terminal 2 — Buka Browser:**
```
http://digital-time-capsule.test
```

**Login:**
- Username: `user1`
- Password: `password123`

---

## ⚙️ Setup Virtual Host (XAMPP) — One Time Only

### Edit Apache VirtualHost
File: `D:\xampp\apache\conf\extra\httpd-vhosts.conf`

Tambah di akhir:
```apache
<VirtualHost *:80>
    ServerName digital-time-capsule.test
    DocumentRoot "D:/Apps/Laragon/laragon/www/digital-time-capsule/public"
    <Directory "D:/Apps/Laragon/laragon/www/digital-time-capsule/public">
        Require all granted
        AllowOverride All
    </Directory>
</VirtualHost>
```

### Edit Windows Hosts File
File: `C:\Windows\System32\drivers\etc\hosts`

Tambah:
```
127.0.0.1  digital-time-capsule.test
```

### Restart Apache
- XAMPP Control Panel → Stop Apache → Start Apache
- Tunggu status hijau

---

## 📁 Key Folders

| Folder | Purpose |
|--------|---------|
| `app/` | Controllers, Models, Middleware |
| `database/migrations/` | Schema definitions |
| `database/seeders/` | Sample data |
| `public/` | Document root (index.php) |
| `resources/views/` | Blade templates |
| `resources/js/` | Vue components |
| `routes/` | URL routes |
| `storage/app/public/` | Uploaded files |

---

## 🛠️ Useful Commands

```powershell
# View all routes
php artisan route:list

# Create new controller
php artisan make:controller ControllerName

# Create new model with migration
php artisan make:model ModelName -m

# Reset database
php artisan migrate:fresh --seed

# Build production assets
npm run build

# Run tests
php artisan test

# Interactive shell
php artisan tinker
```

---

## 🐛 Quick Troubleshooting

| Problem | Solution |
|---------|----------|
| Database error | Check `.env` config + MySQL running |
| Assets not loading | Stop & restart `npm run dev` |
| VirtualHost not works | Restart Apache + `ipconfig /flushdns` |
| Images not showing | Run `php artisan storage:link` |
| Port 3306 error | MySQL not running — start di XAMPP |

---

## 📚 Full Documentation

- **[README.md](README.md)** — Complete guide
- **[SETUP.md](SETUP.md)** — Detailed setup
- **[GITHUB_INSTRUCTIONS.md](GITHUB_INSTRUCTIONS.md)** — Push to GitHub

---

**Ready? Start with:** `npm run dev` 🎉
