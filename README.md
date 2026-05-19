# Ice Stream

Aplikasi streaming video berbasis **Laravel 13** + **Vite** (Blade + Tailwind). Ada halaman landing, browse video, pemutar per video, autentikasi web sederhana, dan API untuk upload/list video.

---

## Yang perlu dipasang di komputer

| Tool | Catatan |
|------|-----------|
| **PHP 8.3+** | Contoh: Laragon, XAMPP, atau PHP standalone. |
| **Composer** | [getcomposer.org](https://getcomposer.org/) |
| **Node.js 20+** & npm | Untuk Vite (`npm run dev` / `npm run build`). |
| **MySQL** (disarankan) | Buat database kosong sendiri (nama bebas, harus sama dengan `.env`). |
| **Git** | Untuk clone & push/pull. |

---

## Git workflow singkat

Jika kamu baru saja commit tapi `git push` mengatakan `Everything up-to-date`, biasanya karena:

1. Kamu sedang berada di branch yang berbeda dari branch yang ingin kamu push.
2. Branch lokal sudah sinkron dengan remote, tetapi commitmu ada di branch lain.
3. Kamu belum mem-push branch yang benar ke remote.

Langkah sinkronisasi umum:

```bash
# lihat branch sekarang
git branch --show-current

# lihat status dan apakah branch lokal di depan/di belakang remote
git status -sb

# ambil update terbaru dari remote
git fetch origin

# push branch saat ini ke remote
git push origin $(git branch --show-current)
```

Jika ada perubahan baru di `main` dan kamu ingin ambil ke branch fitur:

```bash
git checkout main
git pull origin main
git checkout nama-branch-mu
git merge main
# atau jika ingin rebase:
# git rebase main

git push origin nama-branch-mu
```

> Catatan: `git push` hanya akan mengirim commit pada branch yang aktif. Jika kamu berada di `main` tetapi commitmu ada di branch `cursor/video-category-support`, maka `main` akan tampak sudah up to date.

---

## Menjalankan project (setelah `git pull`)

### 1. Masuk ke folder project

```bash
cd ice-stream
```

### 2. Salin environment

```bash
copy .env.example .env
```

Di Linux/macOS: `cp .env.example .env`

### 3. Isi `.env` — database & URL

**Opsi A — MySQL (cocok untuk Laragon / XAMPP)**

Di phpMyAdmin atau client MySQL, buat database baru (misalnya `ice_stream` atau `ice-stream` — yang penting **sama persis** dengan `DB_DATABASE` di `.env`).

Contoh isian:

```env
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ice_stream
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan `DB_USERNAME` / `DB_PASSWORD` dengan user MySQL kamu (Laragon biasanya `root` tanpa password).

**Opsi B — SQLite (tanpa MySQL)**

Di `.env`:

```env
DB_CONNECTION=sqlite
```

Pastikan file database ada:

```bash
type nul > database\database.sqlite
```

(Linux/macOS: `touch database/database.sqlite`)

### 4. Install dependency PHP & JS

```bash
composer install
npm install
```

### 5. App key & migrasi

```bash
php artisan key:generate
php artisan migrate
```

Kalau migrasi error **tabel sudah ada** (misalnya duplikat migration), perbaiki dulu file migration yang bentrok, lalu jalankan lagi `migrate`.

### 6. Symlink storage (agar file video/thumbnail bisa di-`asset('storage/...')`)

```bash
php artisan storage:link
```

### 7. User bawaan untuk login web (opsional tapi disarankan)

```bash
php artisan db:seed
```

Setelah itu kamu bisa login di **`/login`** dengan:

- **Email:** `test@example.com`  
- **Password:** `password`  

Jalankan ulang `db:seed` kapan saja untuk meng-reset user dev itu (aman, pakai `updateOrCreate`).

### 8. Jalankan server

**Terminal 1 — Laravel**

```bash
php artisan serve
```

Buka: [http://127.0.0.1:8000](http://127.0.0.1:8000)

**Terminal 2 — Vite (CSS/JS hot reload)**

```bash
npm run dev
```

Tanpa `npm run dev`, halaman tetap bisa dibuka tapi aset Vite mungkin tidak termuat sempurna di mode development.

**Sekali jalan (Composer script):** `composer run dev` — menjalankan `php artisan serve`, queue, log tail, dan `npm run dev` paralel (memakai `npx concurrently`; pastikan `npm install` sudah pernah dijalankan).

---

## Ringkasan route penting

| URL | Fungsi |
|-----|--------|
| `/` | Landing |
| `/videos` | Browse + filter + search |
| `/videos/{id}` | Putar video |
| `/login` | Login web |
| `/my-list` | Halaman “My List” (stub) |
| `/api/videos` | API list video |
| `POST /api/videos` | Upload video (perlu login / token sesuai setup API) |

---

## API singkat (untuk Postman / frontend lain)

- `GET http://127.0.0.1:8000/api/videos` — daftar video  
- `POST http://127.0.0.1:8000/api/register` — daftar user  
- `POST http://127.0.0.1:8000/api/login` — login (API)  

Video upload disimpan di `storage/app/public/videos` dan diakses lewat `/storage/...` setelah `storage:link`.

---

## Git: `push` ditolak (`fetch first` / `rejected`)

Artinya di **GitHub** branch yang kamu push (misalnya `main`) punya commit **yang belum ada di laptop kamu** — biasanya karena push dari mesin lain, merge PR di web, atau clone lama.

**Jangan** asal `push --force` ke `main` kalau tidak sengaja menimpa kerja orang.

Langkah aman:

```bash
git pull origin main --rebase
```

Kalau lebih nyaman merge:

```bash
git pull origin main
```

Selesai tanpa konflik, baru:

```bash
git push origin main
```

### Popup Windows Credential Manager

Itu Windows yang minta **login ke GitHub** untuk HTTPS. Pilih salah satu:

- Login akun GitHub lewat jendela itu, atau  
- Pakai **Personal Access Token** sebagai “password” (GitHub → Settings → Developer settings → Tokens), atau  
- Pakai **SSH** (`git@github.com:...`) supaya tidak sering pakai Credential Manager untuk HTTPS.

---

## Lisensi

Project ini memakai kerangka Laravel; lisensi mengikuti file `LICENSE` di repository (MIT bawaan Laravel skeleton kecuali diubah).
