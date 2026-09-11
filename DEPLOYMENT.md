# Panduan Deploy Web Portfolio ke Render.com via Docker

Dokumentasi ini menjelaskan langkah demi langkah untuk mendeploy aplikasi web portfolio Laravel ini ke **Render.com** menggunakan **Docker** dan database **MySQL**.

---

## 1. Persiapan Awal (Prerequisites)

1. Pastikan seluruh perubahan kode telah di-commit dan di-push ke repository Git Anda (GitHub atau GitLab):
   ```bash
   git add .
   git commit -m "feat: setup docker and render deployment config"
   git push origin main
   ```
2. Buat instance database **MySQL** di cloud (misalnya menggunakan salah satu penyedia gratis berikut):
   - **[TiDB Cloud Serverless](https://tidbcloud.com/)** (Rekomendasi: Free tier 25GB, latensi rendah jika memilih region Singapore / Tokyo).
   - **[Aiven MySQL](https://aiven.io/)**
   - **[Clever Cloud MySQL](https://www.clever-cloud.com/)**
   - Atau instance MySQL / MariaDB di VPS Anda sendiri.
3. Catat kredensial koneksi MySQL:
   - `Host` (misal: `gateway01.ap-southeast-1.prod.aws.tidbcloud.com`)
   - `Port` (umumnya `3306` atau `4000` untuk TiDB)
   - `Database Name`
   - `Username`
   - `Password`

---

## 2. Cara Deploy di Render.com

Ada dua cara untuk mendeploy: **Metode 1 (Manual Web Service)** atau **Metode 2 (Render Blueprint)**.

### Metode 1: Manual Web Service (Paling Fleksibel & Direkomendasikan)

1. Buka dashboard [Render.com](https://dashboard.render.com/) dan login.
2. Klik tombol **New +** di pojok kanan atas, lalu pilih **Web Service**.
3. Hubungkan repository GitHub/GitLab Anda (pilih repository portofolio ini).
4. Isi konfigurasi dasar:
   - **Name**: `porto-web` (atau nama pilihan Anda).
   - **Region**: `Singapore` (paling dekat untuk akses Indonesia).
   - **Branch**: `main` (atau branch utama Anda).
   - **Runtime**: Pilih **Docker**.
   - **Instance Type**: Pilih **Free**.
5. Gulir ke bawah ke bagian **Environment Variables** dan klik **Add Environment Variable**. Tambahkan variabel-variabel berikut:

| Key | Value Contoh | Catatan |
|---|---|---|
| `APP_NAME` | `Helmy Yunan Portfolio` | Nama aplikasi |
| `APP_ENV` | `production` | Mode produksi |
| `APP_DEBUG` | `false` | Matikan debug demi keamanan |
| `APP_KEY` | `base64:xxxx...` | Jalankan `php artisan key:generate --show` di terminal lokal lalu salin hasilnya |
| `APP_URL` | `https://nama-service.onrender.com` | URL yang diberikan oleh Render |
| `LOG_CHANNEL` | `stderr` | Agar log error tampil di dashboard Render |
| `DB_CONNECTION` | `mysql` | Driver MySQL |
| `DB_HOST` | `gateway.xxxx.cloud` | Host MySQL Anda |
| `DB_PORT` | `3306` | Port MySQL Anda |
| `DB_DATABASE` | `porto` | Nama database |
| `DB_USERNAME` | `user_anda` | Username database |
| `DB_PASSWORD` | `password_anda` | Password database |
| `SESSION_DRIVER` | `database` | Sesi disimpan di database |
| `CACHE_STORE` | `database` | Cache di database |
| `QUEUE_CONNECTION` | `sync` | Queue proses langsung |
| `SEED_ON_DEPLOY` | `false` | Otomatis `true` saat pertama kali jika database kosong |

6. Di bagian **Advanced**:
   - **Health Check Path**: Isi dengan `/up`.
   - **Auto-Deploy**: Pilih `Yes` (agar setiap `git push` otomatis memicu deploy ulang).
7. Klik **Create Web Service**.
8. Render akan mulai mem-build Docker image dan menjalankan container. Anda dapat memantau prosesnya di tab **Logs**.

---

### Metode 2: Menggunakan Blueprint (`render.yaml`)

1. Repository ini sudah dilengkapi file `render.yaml`.
2. Di dashboard Render, klik **New +** -> **Blueprint**.
3. Pilih repository Anda. Render akan otomatis membaca file `render.yaml`.
4. Anda akan diminta mengisi nilai untuk variabel yang belum terisi (seperti `APP_KEY`, `APP_URL`, dan kredensial MySQL).
5. Klik **Apply**.

---

## 3. Proses Otomatis Saat Container Dijalankan (`entrypoint.sh`)

Container Docker ini dirancang pintar melalui script `docker/entrypoint.sh`:
1. **Menunggu Database**: Jika database cloud MySQL membutuhkan beberapa detik untuk *cold-start*, script akan menunggu hingga koneksi berhasil.
2. **Migrasi Otomatis**: Menjalankan `php artisan migrate --force` secara otomatis.
3. **Seeding Awal**:
   - Pada deploy pertama kali ke database yang masih kosong (0 users), script otomatis menjalankan `php artisan db:seed --force` untuk mengisi profil, proyek, keahlian, dan user admin.
   - Jika Anda ingin memaksa seeding ulang di deploy berikutnya, cukup ubah Environment Variable `SEED_ON_DEPLOY=true`.
4. **Optimasi Cache**: Menjalankan `config:cache`, `route:cache`, dan `view:cache` untuk kecepatan akses maksimal.
5. **Reverse Proxy & SSL**: Laravel sudah dikonfigurasi dengan `trustProxies(at: '*')` sehingga seluruh URL, aset, dan redirect langsung menggunakan protokol `https://` yang disediakan Render.

---

## 4. Akun Admin Filament di Produksi

Setelah deploy berhasil dan database ter-seed:
- URL Admin Panel: `https://nama-service.onrender.com/admin`
- **Email**: `helmy@helmyyunan.dev`
- **Password**: `password`

> [!CAUTION]
> Segera login ke panel admin setelah deploy selesai dan ganti password akun admin Anda melalui menu profil/users.

---

## 5. Catatan Media Storage (File Uploads)

Pada tier Free Render, file sistem lokal bersifat *ephemeral* (reset saat deploy baru atau restart).
- Untuk file statis bawaan proyek (foto default, resume PDF di `public/assets`), file tersebut sudah tersimpan di dalam Docker image dan selalu tersedia.
- Jika di kemudian hari Anda mengunggah media baru melalui Filament Admin Panel dan ingin file tersebut permanen, disarankan mengonfigurasi storage cloud S3-compatible (seperti **Cloudflare R2** yang gratis hingga 10GB/bulan) dengan mengisi env:
  - `FILESYSTEM_DISK=s3`
  - `AWS_ACCESS_KEY_ID`
  - `AWS_SECRET_ACCESS_KEY`
  - `AWS_BUCKET`
  - `AWS_ENDPOINT`
  - `AWS_URL`

---

## 6. Testing Lokal dengan Docker (Opsional)

Jika Anda memiliki Docker di komputer lokal dan ingin menguji coba sebelum deploy:
```bash
# Salin konfigurasi env dan generate key
docker compose up --build
```
Aplikasi akan dapat diakses di `http://localhost:8000`.
