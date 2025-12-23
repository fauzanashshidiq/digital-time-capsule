# Digital Time Capsule - Setup & Run Guide

## Ringkasan Status Setup

**Status:** ✅ Project sudah siap dijalankan

Semua komponen kunci sudah dikonfigurasi dan dijalankan. Berikut dokumentasi lengkap untuk setup dan menjalankan project.

---

## 📋 Langkah-Langkah Setup (Fresh Install)

### 1. Install PHP Dependencies
```powershell
composer install
```
**Output:** Menginstall semua dependency dari `composer.lock` dan menjalankan `package:discover` untuk Laravel packages.

### 2. Persiapan Environment File
```powershell
copy .env.example .env
```
**Konfigurasi `.env` — sesuaikan nilai berikut:**
```env
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database (XAMPP/MariaDB)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=digital_time_capsule
DB_USERNAME=root
DB_PASSWORD=

# Session & Cache
SESSION_DRIVER=file
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### 3. Generate Application Key
```powershell
php artisan key:generate
```
**Output:** `INFO  Application key set successfully.`

### 4. Jalankan Migrations & Seeding
```powershell
php artisan migrate:fresh --seed
```
**Database tables dibuat:**
- `users` — user accounts (dengan username auth)
- `capsules` — time capsule entries
- `capsule_images` — images untuk setiap capsule
- `cache`, `jobs`, `migrations` — internal Laravel tables

**Data seed:** `CapsuleSeeder` menambahkan sample data untuk testing.

### 5. Buat Storage Symlink
```powershell
php artisan storage:link
```
**Output:** Membuat symlink dari `storage/app/public` ke `public/storage` untuk akses file public.

### 6. Install JavaScript Dependencies
```powershell
npm install
```
**Menginstall:** Vue.js, Tailwind CSS, Vite, dan dependencies lainnya dari `package-lock.json`.

### 7. Build Frontend Assets
**Untuk Development (dengan watch mode):**
```powershell
npm run dev
```
**Untuk Production:**
```powershell
npm run build
```

---

## 🌐 Akses Aplikasi via XAMPP

### Setup VirtualHost (One-Time)

#### A. Edit Apache VirtualHost Configuration
Buka file: `D:\Apps\xampp\apache\conf\extra\httpd-vhosts.conf`

Tambahkan di akhir file:
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

**Simpan file (Ctrl+S).**

#### B. Edit Windows Hosts File
Buka file: `C:\Windows\System32\drivers\etc\hosts` (sebagai Administrator)

Tambahkan:
```
127.0.0.1  digital-time-capsule.test
```

**Simpan file (Ctrl+S).**

#### C. Restart Apache
1. Buka **XAMPP Control Panel** (`D:\Apps\xampp\xampp-control.exe`)
2. Klik tombol **Stop** pada Apache
3. Tunggu beberapa detik
4. Klik tombol **Start** pada Apache
5. Tunggu Apache status menjadi **hijau (running)**

#### D. Flush DNS (optional)
```powershell
ipconfig /flushdns
```

### Akses Aplikasi
Buka browser dan navigasi ke:
```
http://digital-time-capsule.test
```

---

## 🚀 Daily Development Workflow

### 1. Pastikan XAMPP Berjalan
- Buka XAMPP Control Panel
- Start **Apache** dan **MySQL**

### 2. Jalankan Asset Watch Mode
Di folder project (PowerShell):
```powershell
npm run dev
```
Ini akan:
- Compile Tailwind CSS
- Build JavaScript components
- Auto-refresh saat ada perubahan file

### 3. Akses Aplikasi
Buka browser: `http://digital-time-capsule.test`

### 4. Logout dari Terminal Dev
Tekan `Ctrl+C` untuk menghentikan `npm run dev` saat selesai.

---

## 📁 Project Structure

```
digital-time-capsule/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Request handlers
│   │   └── Requests/             # Form validation
│   ├── Models/                   # Database models
│   │   ├── Capsule.php
│   │   ├── CapsuleImage.php
│   │   └── User.php
│   └── Providers/
├── database/
│   ├── migrations/               # Database schema
│   ├── factories/
│   └── seeders/                  # Sample data
├── public/                        # Document root (setup di VirtualHost)
│   ├── index.php
│   ├── storage/                  # Symlink ke storage/app/public
│   └── manifest.json             # PWA manifest
├── resources/
│   ├── css/                      # Tailwind CSS
│   ├── js/                       # Vue.js components
│   └── views/                    # Blade templates
├── routes/
│   ├── web.php                   # Web routes
│   └── auth.php                  # Auth routes (Breeze)
├── storage/
│   ├── app/public/               # Public file uploads
│   └── logs/                     # Log files
├── .env                          # Environment config
├── composer.json / package.json  # Dependencies
├── vite.config.js                # Frontend bundler config
└── tailwind.config.js            # Tailwind CSS config
```

---

## 🔧 Troubleshooting

### Issue: "Table 'digital_time_capsule.sessions' doesn't exist"
**Solution:** Sessions sudah diganti ke `SESSION_DRIVER=file` di `.env`.  
Jika muncul lagi, pastikan `.env` sudah tersimpan dan refresh browser.

### Issue: "Route [dashboard] not defined"
**Solution:** Panggil route dengan nama yang benar atau debug routes:
```powershell
php artisan route:list
```

### Issue: Assets (CSS/JS) tidak ter-load
**Solution:** Pastikan `npm run dev` berjalan dan compile tidak error.

### Issue: Uploaded images tidak tampil
**Solution:** Pastikan `php artisan storage:link` sudah dijalankan.

### Issue: Database tidak terkoneksi
**Solution:** 
- Cek MySQL running di XAMPP Control Panel
- Verifikasi konfigurasi `.env`: `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD`
- Test koneksi: `php artisan tinker` → `DB::connection()->getPdo()`

---

## 📝 Environment Variables (.env)

| Variable | Default | Keterangan |
|----------|---------|-----------|
| `APP_NAME` | Laravel | Nama aplikasi (digunakan di views) |
| `APP_ENV` | local | Environment: `local`, `production` |
| `APP_DEBUG` | true | Debug mode (jangan enable di production) |
| `APP_URL` | http://localhost | URL aplikasi |
| `DB_CONNECTION` | mysql | Database driver |
| `DB_DATABASE` | digital_time_capsule | Nama database |
| `SESSION_DRIVER` | file | Session storage: `file`, `database` |
| `CACHE_STORE` | database | Cache driver |
| `QUEUE_CONNECTION` | database | Queue driver |

---

## ✅ Checklist Setup Selesai

- [x] PHP dependencies (`composer install`)
- [x] Application key (`php artisan key:generate`)
- [x] Database migrations (`php artisan migrate:fresh --seed`)
- [x] Storage symlink (`php artisan storage:link`)
- [x] JavaScript dependencies (`npm install`)
- [x] VirtualHost XAMPP configuration
- [x] Hosts file entry
- [x] Apache restart
- [ ] First login test (username/password dari seeder atau register)

---

## 🎯 Next Steps

1. **Start development:** 
   ```powershell
   npm run dev
   ```
   Buka `http://digital-time-capsule.test`

2. **Login atau Register** untuk test aplikasi

3. **Develop features** — edit files di `resources/` dan `app/` akan auto-update via `npm run dev`

---

**Created:** December 23, 2025  
**Status:** Ready for Development ✅
