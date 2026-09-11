#!/bin/sh
set -e

echo "===> Memulai inisialisasi aplikasi Laravel..."

# 1. Pastikan folder storage dan bootstrap cache ada dan memiliki permission yang tepat
mkdir -p /app/storage/framework/cache/data \
         /app/storage/framework/sessions \
         /app/storage/framework/views \
         /app/storage/logs \
         /app/storage/app/public \
         /app/bootstrap/cache

# 2. Inisialisasi Database
DB_CONN="${DB_CONNECTION:-sqlite}"
echo "===> Menggunakan driver database: $DB_CONN"

if [ "$DB_CONN" = "sqlite" ]; then
    DB_FILE="${DB_DATABASE:-/app/database/database.sqlite}"
    mkdir -p "$(dirname "$DB_FILE")"
    if [ ! -f "$DB_FILE" ]; then
        echo "===> Membuat file SQLite di $DB_FILE..."
        touch "$DB_FILE"
    fi
fi

# Tunggu database siap jika menggunakan MySQL atau PostgreSQL eksternal
if [ "$DB_CONN" = "mysql" ] || [ "$DB_CONN" = "mariadb" ] || [ "$DB_CONN" = "pgsql" ]; then
    echo "===> Mengecek koneksi database ke $DB_HOST:${DB_PORT:-3306}..."
    RETRIES=10
    COUNT=0
    until php -r "
        try {
            DB::connection()->getPdo();
            exit(0);
        } catch (\Throwable \$e) {
            fwrite(STDERR, 'Menunggu database (' . \$e->getMessage() . ')...' . PHP_EOL);
            exit(1);
        }
    " 2>/dev/null || [ "$COUNT" -ge "$RETRIES" ]; do
        COUNT=$((COUNT + 1))
        echo "Database belum siap, mencoba lagi dalam 3 detik ($COUNT/$RETRIES)..."
        sleep 3
    done
fi

# 3. Buat symbolic link storage
echo "===> Memperbarui storage symlink..."
php artisan storage:link --force || true

# 4. Jalankan Migrasi Database
echo "===> Menjalankan migrasi database..."
php artisan migrate --force

# 5. Inisialisasi Seeding jika Database Kosong atau SEED_ON_DEPLOY=true
SHOULD_SEED=false

if [ "$SEED_ON_DEPLOY" = "true" ] || [ "$SEED_ON_DEPLOY" = "1" ]; then
    SHOULD_SEED=true
else
    # Cek apakah tabel users masih kosong (deploy pertama kali)
    USER_COUNT=$(php -r "
        try {
            echo \App\Models\User::count();
        } catch (\Throwable \$e) {
            echo '-1';
        }
    " 2>/dev/null || echo "-1")

    if [ "$USER_COUNT" = "0" ]; then
        echo "===> Terdeteksi database baru/kosong (0 users). Mengaktifkan seeding awal..."
        SHOULD_SEED=true
    fi
fi

if [ "$SHOULD_SEED" = "true" ]; then
    echo "===> Menjalankan database seeder (DatabaseSeeder)..."
    php artisan db:seed --force || echo "Peringatan: Gagal menjalankan seeder, melanjutkan..."
fi

# 6. Optimasi Cache Laravel untuk Production
if [ "${APP_ENV:-production}" = "production" ]; then
    echo "===> Menjalankan optimasi cache (config, routes, views)..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

echo "===> Inisialisasi selesai. Menjalankan server pada port ${PORT:-10000}..."
exec "$@"
