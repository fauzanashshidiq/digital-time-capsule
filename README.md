# Digital Time Capsule 📦⏰

Aplikasi Laravel untuk membuat dan menyimpan digital time capsule — tempat menyimpan pesan, foto, dan cerita untuk dibuka di masa depan.

## 🎯 Fitur Utama

- ✅ Autentikasi user (registrasi & login dengan username)
- ✅ Membuat time capsule dengan judul dan deskripsi
- ✅ Upload multiple images ke setiap capsule
- ✅ Scheduled opening — capsule bisa dibuka sesuai waktu yang ditentukan
- ✅ Responsive design dengan Tailwind CSS
- ✅ PWA support (Progressive Web App)

---

## 🛠️ Tech Stack

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Laravel** | 11.x | Backend framework |
| **Laravel Breeze** | - | Authentication scaffold |
| **Vue.js** | 3 | Frontend framework |
| **Tailwind CSS** | 3 | Styling |
| **Vite** | 5 | Frontend bundler |
| **MySQL/MariaDB** | - | Database |
| **PHP** | 8.2+ | Language |

---

## 📋 Prerequisites

Sebelum setup, pastikan sudah install:

- **PHP** ≥ 8.2 ([Download](https://www.php.net))
- **Composer** ([Download](https://getcomposer.org))
- **Node.js** & **npm** ([Download](https://nodejs.org))
- **MySQL/MariaDB** atau **XAMPP** ([Download](https://www.apachefriends.org))
- **Git** ([Download](https://git-scm.com))

Verifikasi instalasi:
```powershell
php --version
composer --version
node --version
npm --version
```

---

## 🚀 Quick Start (5 Menit)

### 1. Clone & Install
```powershell
git clone https://github.com/username/digital-time-capsule.git
cd digital-time-capsule
composer install
npm install
```

### 2. Setup Environment
```powershell
copy .env.example .env
php artisan key:generate
```

Edit `.env` untuk database config (lihat bagian [Setup Project](#-setup-project-fresh-install) di bawah).

### 3. Database & Migration
```powershell
# Create database: digital_time_capsule di MySQL

php artisan migrate:fresh --seed
php artisan storage:link
```

### 4. Start Development
**Terminal 1:**
```powershell
npm run dev
```

**Terminal 2 (buka browser):**
```
http://digital-time-capsule.test
```

Login dengan:
- **Username:** `user1`
- **Password:** `password123`

---

## 🚀 Setup Project (Fresh Install - Detail)

### 1. Clone Repository
```powershell
git clone https://github.com/username/digital-time-capsule.git
cd digital-time-capsule
```

### 2. Install PHP Dependencies
```powershell
composer install
```

### 3. Setup Environment File
```powershell
copy .env.example .env
php artisan key:generate
```

Edit `.env` dan sesuaikan:
```env
APP_NAME="Digital Time Capsule"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://digital-time-capsule.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=digital_time_capsule
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Create Database
**Menggunakan phpMyAdmin:**
1. Buka `http://localhost/phpmyadmin`
2. Klik "New" → buat database bernama `digital_time_capsule`
3. Charset: `utf8mb4_unicode_ci`

**Atau gunakan CLI:**
```powershell
mysql -u root -e "CREATE DATABASE digital_time_capsule CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 5. Run Migrations & Seeding
```powershell
php artisan migrate:fresh --seed
```

**Tables dibuat:**
- `users` — akun user
- `capsules` — time capsule entries
- `capsule_images` — images
- `cache`, `jobs`, `migrations` — Laravel internal

### 6. Create Storage Symlink
```powershell
php artisan storage:link
```

Untuk Windows, jalankan PowerShell **sebagai Administrator** jika error symlink.

### 7. Install JavaScript Dependencies
```powershell
npm install
```

### 8. Build Frontend Assets (Production)
```powershell
npm run build
```

Atau untuk development dengan watch mode:
```powershell
npm run dev
```

---

## 🌐 Access Application (Windows + XAMPP)

### Setup Virtual Host (One-Time)

#### 1. Edit Apache VirtualHost Configuration

File path: `D:\xampp\apache\conf\extra\httpd-vhosts.conf`

Buka dengan Notepad dan **tambahkan di akhir file:**
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

**Catatan:** Ganti path `D:/Apps/Laragon/laragon/www/digital-time-capsule` dengan path absolut project Anda.

**Simpan file (Ctrl+S).**

#### 2. Edit Windows Hosts File

File path: `C:\Windows\System32\drivers\etc\hosts`

Buka dengan Notepad sebagai **Administrator** dan **tambahkan:**
```
127.0.0.1  digital-time-capsule.test
```

**Simpan file (Ctrl+S).**

#### 3. Restart Apache

1. Buka **XAMPP Control Panel** (`D:\xampp\xampp-control.exe`)
2. Klik tombol **Stop** pada Apache
3. Tunggu 2-3 detik
4. Klik tombol **Start** pada Apache
5. Tunggu status berubah **HIJAU (running)**

#### 4. Flush DNS (Optional)
```powershell
ipconfig /flushdns
```

#### 5. Access di Browser
```
http://digital-time-capsule.test
```

---

## 💻 Daily Development

### Start Development
```powershell
# Terminal 1 - Asset compilation
npm run dev

# Terminal 2 - Buka browser
# http://digital-time-capsule.test
```

### Stop Development
Tekan `Ctrl+C` pada Terminal 1 untuk stop asset watching.

### Useful Commands
```powershell
# View all routes
php artisan route:list

# Create new controller
php artisan make:controller ControllerName

# Create new model
php artisan make:model ModelName -m

# Run tests
php artisan test

# Check database connection
php artisan tinker
# Lalu ketik: DB::connection()->getPdo();
```

---

## 📁 Project Structure

```
digital-time-capsule/
├── app/                         # Application code
│   ├── Http/Controllers/        # Request handlers
│   ├── Models/                  # Database models
│   └── Providers/               # Service providers
├── database/                    # Database files
│   ├── migrations/              # Schema definitions
│   ├── seeders/                 # Sample data
│   └── factories/               # Model factories
├── public/                      # Document root (accessible from web)
│   ├── index.php                # Entry point
│   └── storage/                 # Symlink to storage/app/public
├── resources/                   # Frontend & view files
│   ├── css/                     # Tailwind CSS
│   ├── js/                      # Vue.js components
│   └── views/                   # Blade templates
├── routes/                      # Route definitions
│   ├── web.php                  # Web routes
│   └── auth.php                 # Auth routes
├── storage/                     # File storage
│   ├── app/public/              # Public uploads
│   ├── framework/               # Cache & views
│   └── logs/                    # Application logs
├── tests/                       # Test files
├── vendor/                      # Composer packages (git ignored)
├── node_modules/                # NPM packages (git ignored)
├── .env                         # Environment config (git ignored)
├── .env.example                 # Environment template
├── .gitignore                   # Git ignore rules
├── composer.json                # PHP dependencies
├── package.json                 # JavaScript dependencies
├── vite.config.js               # Frontend bundler
├── tailwind.config.js           # Tailwind CSS
├── README.md                    # This file
├── SETUP.md                     # Detailed setup guide
└── artisan                      # Laravel CLI
```

---

## 🔐 Default Login Credentials

Database seeding membuat user default:

| Field | Value |
|-------|-------|
| Username | `user1` |
| Password | `password123` |
| Email | user1@example.com |

Atau buat user baru via **Register** page.

---

## 🗄️ Database Schema

### users
| Column | Type | Keterangan |
|--------|------|-----------|
| id | bigint | Primary key |
| name | string | Nama lengkap |
| username | string | **Unique** — login identifier |
| email | string | Unique |
| password | string | Hashed password |
| email_verified_at | timestamp | NULL if not verified |
| created_at | timestamp | |
| updated_at | timestamp | |

### capsules
| Column | Type | Keterangan |
|--------|------|-----------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key ke users |
| title | string | Judul capsule |
| description | text | Deskripsi/isi |
| scheduled_open_date | timestamp | Waktu membuka |
| created_at | timestamp | |
| updated_at | timestamp | |

### capsule_images
| Column | Type | Keterangan |
|--------|------|-----------|
| id | bigint | Primary key |
| capsule_id | bigint | Foreign key ke capsules |
| image_path | string | File path di storage |
| created_at | timestamp | |
| updated_at | timestamp | |

---

## 🐛 Troubleshooting

### ❌ "Table 'digital_time_capsule.xxx' doesn't exist"
**Solusi:**
```powershell
php artisan migrate:fresh --seed
```

### ❌ Database Connection Error
Cek `.env`:
- `DB_HOST` = `127.0.0.1` (atau sesuai setting MySQL Anda)
- `DB_PORT` = `3306`
- `DB_DATABASE` = `digital_time_capsule` (database sudah dibuat)
- `DB_USERNAME` = `root`
- `DB_PASSWORD` = (kosong jika default XAMPP)

Verifikasi koneksi:
```powershell
php artisan tinker
DB::connection()->getPdo();
```

### ❌ VirtualHost tidak works (masih XAMPP page)
Cek:
1. Sudah edit `httpd-vhosts.conf` dan **simpan** (Ctrl+S)?
2. Sudah edit `hosts` file dan **simpan**?
3. Sudah **Restart Apache** (Stop → Start)?
4. Path di `httpd-vhosts.conf` benar?
5. Coba `ipconfig /flushdns` lalu refresh browser

### ❌ npm run dev error
```powershell
rm -r node_modules
npm install
npm run dev
```

### ❌ CSS/JS tidak ter-load (blank page)
- Pastikan `npm run dev` **sedang berjalan**
- Clear browser cache (Ctrl+Shift+Delete)
- Cek browser console untuk error
- Pastikan assets compiled (lihat terminal npm run dev)

### ❌ Images tidak tampil setelah upload
Jalankan:
```powershell
php artisan storage:link
```

Cek file ada di: `storage/app/public/`

### ❌ Permission denied on storage:link (Windows)
Jalankan PowerShell **sebagai Administrator** lalu:
```powershell
php artisan storage:link
```

---

## 📚 Available Commands

### Laravel Artisan
```powershell
php artisan migrate                 # Run migrations
php artisan migrate:rollback        # Rollback migrations
php artisan migrate:fresh --seed    # Reset & seed
php artisan route:list              # List all routes
php artisan make:controller Name    # Create controller
php artisan make:model Name         # Create model
php artisan test                    # Run tests
php artisan tinker                  # Interactive shell
```

### NPM
```powershell
npm run dev                         # Development mode (watch)
npm run build                       # Build for production
npm run lint                        # Lint code
npm run format                      # Format code
```

---

## 🚀 Deployment

### Production Build
```powershell
npm run build
```

Hasilnya di folder `public/build/` untuk assets statis.

### Deploy ke Vercel / Railway
Lihat file `vercel.json` untuk konfigurasi deployment.

---

## 📖 Documentation

- `README.md` — File ini (quick start)
- `SETUP.md` — Panduan setup detail
- [Laravel Docs](https://laravel.com/docs)
- [Vue.js Docs](https://vuejs.org)
- [Tailwind CSS Docs](https://tailwindcss.com)

---

## 📄 License

MIT License — Bebas untuk development dan komersial.

---

## 👨‍💻 Contributing

Untuk kontribusi atau issue:
1. Fork repository
2. Buat branch feature (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

---

**Happy Coding! 🎉**

*Last updated: December 23, 2025*

