# 🚀 GitHub Setup & Push Instructions

Panduan lengkap untuk upload project ke GitHub dan share dengan orang lain.

---

## 📋 Step 1: Create Repository di GitHub

### 1a. Login ke GitHub
- Buka https://github.com
- Login dengan akun Anda (atau create baru jika belum punya)

### 1b. Create New Repository
- Klik tombol **"+" (top-right)** → **"New repository"**
- Atau langsung ke: https://github.com/new

### 1c. Fill Repository Details
| Field | Value |
|-------|-------|
| **Repository name** | `digital-time-capsule` |
| **Description** | `A Laravel app to create and store digital time capsules` |
| **Visibility** | Public (atau Private jika ingin) |
| **Add .gitignore** | ❌ **Uncheck** (sudah ada) |
| **Add LICENSE** | ✅ MIT |

### 1d. Create Repository
Klik tombol **"Create repository"** hijau.

---

## 📝 Step 2: Initialize Git Locally

Buka PowerShell di folder project:
```powershell
cd D:\Apps\Laragon\laragon\www\digital-time-capsule
```

### 2a. Initialize Git (jika belum ada .git folder)
```powershell
git init
git config user.name "Your Name"
git config user.email "your.email@example.com"
```

### 2b. Add Remote Origin
GitHub akan show URL seperti ini — copy & paste:
```powershell
git remote add origin https://github.com/YOUR-USERNAME/digital-time-capsule.git
git branch -M main
```

Verifikasi:
```powershell
git remote -v
```

Output:
```
origin  https://github.com/YOUR-USERNAME/digital-time-capsule.git (fetch)
origin  https://github.com/YOUR-USERNAME/digital-time-capsule.git (push)
```

---

## 📤 Step 3: Commit & Push ke GitHub

### 3a. Check Status
```powershell
git status
```

Output akan show untracked files (vendor, node_modules akan di-ignore via .gitignore)

### 3b. Add All Files
```powershell
git add .
```

Verifikasi perubahan:
```powershell
git status
```

### 3c. Create First Commit
```powershell
git commit -m "Initial commit: Digital Time Capsule Laravel app setup"
```

### 3d. Push ke GitHub
```powershell
git push -u origin main
```

**First time akan minta login:**
- Method A: GitHub login di browser (recommended)
- Method B: Personal Access Token (PAT)

**Jika diminta keamanan (2FA):**
1. Gunakan **GitHub CLI** atau **Personal Access Token**
2. Baca: https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token

---

## ✅ Verify di GitHub

1. Refresh halaman repository di GitHub
2. Lihat semua files sudah ter-upload ✅
3. **README.md** akan tampil di halaman utama
4. Lihat **Insights** → **Network** untuk melihat commit history

---

## 📖 Share Project dengan Orang Lain

### Instruksi untuk Clone Project

Bagikan URL ini ke orang lain:
```
https://github.com/YOUR-USERNAME/digital-time-capsule
```

**Orang lain bisa clone dengan:**
```powershell
git clone https://github.com/YOUR-USERNAME/digital-time-capsule.git
cd digital-time-capsule
```

Lalu follow **README.md** untuk setup (composer install, npm install, migration, etc).

---

## 🔄 Daily Development Workflow

Setelah initial commit, workflow akan seperti ini:

### 1. Pull Latest Changes
```powershell
git pull origin main
```

### 2. Create Feature Branch (Optional)
```powershell
git checkout -b feature/amazing-feature
```

### 3. Make Changes
Edit files, test, etc.

### 4. Check Status
```powershell
git status
```

### 5. Add & Commit
```powershell
git add .
git commit -m "Add amazing feature"
```

### 6. Push
```powershell
git push origin feature/amazing-feature
```

### 7. Create Pull Request (PR) di GitHub
- GitHub akan show tombol "Compare & pull request"
- Klik → Create PR
- Merge ke `main` branch

---

## 🛑 Important Files (Do NOT Commit)

File ini **HARUS** di `.gitignore` (sudah ada):
- `.env` — Environment secret (API keys, passwords)
- `vendor/` — PHP packages
- `node_modules/` — JavaScript packages
- `storage/logs/` — Log files
- `public/storage/` — Symlink
- `/build/` — Generated assets

---

## 🔒 Protecting Secrets

**JANGAN pernah commit:**
- Database password
- API keys
- Private credentials

**Cara aman:**
1. `.env` sudah di `.gitignore` ✅
2. `.env.example` berisi template tanpa secrets ✅
3. Dokumentasi di README.md untuk orang lain ✅

---

## 📊 Useful GitHub Commands

### View commit history
```powershell
git log --oneline
```

### View changes
```powershell
git diff
```

### Undo last commit (belum push)
```powershell
git reset --soft HEAD~1
```

### Undo last commit (sudah push) — harus force push
```powershell
git reset --soft HEAD~1
git push -f origin main
```

⚠️ **Hati-hati dengan `git reset --hard` — akan delete changes!**

---

## 🆘 Troubleshooting GitHub Push

### Error: "fatal: Authentication failed"
**Solusi:**
- Setup SSH keys: https://docs.github.com/en/authentication/connecting-to-github-with-ssh
- Atau gunakan Personal Access Token (PAT)

### Error: "fatal: refusing to merge unrelated histories"
```powershell
git pull origin main --allow-unrelated-histories
git push -u origin main
```

### Error: "The following untracked working tree files would be overwritten by merge"
```powershell
git clean -fd
git pull origin main
```

### Error: "fatal: not a git repository"
```powershell
cd path/to/digital-time-capsule
git init
```

---

## 📋 Checklist Siap Push

Sebelum push ke GitHub, pastikan:

- [ ] `.env` file **NOT** committed (di .gitignore)
- [ ] `vendor/` folder **NOT** committed (di .gitignore)
- [ ] `node_modules/` folder **NOT** committed (di .gitignore)
- [ ] `.gitignore` sudah ada dan benar
- [ ] `README.md` sudah update dengan setup instructions
- [ ] `.env.example` sudah ada dengan template config
- [ ] `composer.json` dan `package.json` **committed** ✅
- [ ] `composer.lock` dan `package-lock.json` sudah ada

Verifikasi dengan:
```powershell
git status
```

Hanya seharusnya ada file `modified` atau `new file` yang penting (source code, docs, config).

---

## 🎉 Sukses!

Selamat, project Anda sudah di GitHub! 

**Next steps:**
1. Share link ke teman/tim
2. Mereka bisa clone dan setup dengan README.md
3. Collaborate dengan Pull Requests
4. Deploy ke production (Vercel, Railway, Heroku)

---

**Happy Coding! 🚀**

*Created: December 23, 2025*
