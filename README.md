# Zephyr Portfolio — Personal Information & Professional Journey System

> **Helmy Yunan Nasution** — Software Engineer & System Architect  
> Specializing in High-Performance Distributed Backends, Relational Modeling, and Scalable Architecture.

A modern, production-grade personal digital experience built with Laravel 13, PHP 8.4, Tailwind CSS 4, Alpine.js, Livewire, and Filament 5.

---

## Architecture & Tech Stack

- **Framework**: Laravel 13.x running on PHP 8.4
- **Database**: MySQL 8.0+ / MariaDB with indexed relational schemas
- **CMS & Administration**: Filament 5 Administrative Panel
- **Frontend Layer**: Laravel Blade components, Tailwind CSS 4 (Theme tokens), Alpine.js, GSAP ScrollTrigger
- **Reactive UI**: Livewire 4 (Journey autoplay, Timeline filtering)
- **Search Engine**: Laravel Scout (Database engine) multi-domain search across Projects, Experiences, Skills, Articles
- **Media Engine**: Spatie Media Library with optimized WebP conversions
- **Cache Engine**: Relational Database cache store hardened with Laravel 13 `serializable_classes` allowlists and self-healing resilience
- **Security & Headers**: Strict CSP, HSTS, X-Frame-Options, Honeypot bot protection, and sanitized inputs

---

## Design System

- **Background Palette**: Surface `#080808` (Obsidian), `#0E0D0C`, `#151311`, `#1E1A17`
- **Accent Palette**: Burnt Orange `#C45A19`, Radiant Amber `#E47A2E`
- **Text Palette**: Warm White `#F5F1EA`, Muted Gray `#9E958B`, Dim `#70685F`
- **Typography**: Space Grotesk (Headings), Inter (Body copy), JetBrains Mono (Technical telemetry)
- **Styling Paradigm**: Subtle glassmorphic cards (`glass-card`), ambient radial gradients, and keyboard-first accessibility

---

## System Requirements

- PHP `>= 8.4` (Extensions: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `gd` or `imagick`)
- Composer `>= 2.7`
- Node.js `>= 20.x` & NPM `>= 10.x`
- MySQL `>= 8.0` or MariaDB `>= 10.5`

---

## Quick Installation Guide

### 1. Clone the Repository
```bash
git clone https://github.com/your-org/portfolio.git
cd portfolio
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Configure your `.env` database and cache parameters:
```dotenv
APP_NAME="Helmy Yunan Nasution"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=helmy_portfolio
DB_USERNAME=root
DB_PASSWORD=your_password_here

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
SCOUT_DRIVER=database
```

### 4. Storage Link
```bash
php artisan storage:link
```

### 5. Database Setup & Seed Data
Execute database migrations and population seeders:
```bash
php artisan migrate:fresh --seed
```

### 6. Administrative Panel Access
The database seeder creates an initial administrator account:
- **Admin URL**: `http://localhost:8000/admin`
- **Email**: `helmy@helmyyunan.dev`
- **Default Seeder Password**: Configured via seeder (`password` in local seed environment; change immediately in production)

---

## Frontend Development & Asset Compilation

```bash
# Start Vite development server with Hot Module Replacement
npm run dev

# Compile optimized production bundle
npm run build
```

---

## Production Optimization & Deployment Checklist

### Production Environment Variables
In your production `.env`:
```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Cache drivers
CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

### Production Optimizations
Execute the framework cache commands before serving traffic:
```bash
# 1. Clear development caches
php artisan optimize:clear

# 2. Build production assets
npm run build

# 3. Cache configuration, routes, and blade views
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 4. Optimize composer autoloading
composer install --optimize-autoloader --no-dev
```

### Web Server Setup (Nginx)
Ensure your Nginx configuration routes all traffic through `public/index.php`:
```nginx
server {
    listen 443 ssl http2;
    server_name your-domain.com;
    root /var/www/portfolio/public;

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## Data Safety & Backup Strategy

1. **Database Snapshots**:
   ```bash
   mysqldump -u root -p helmy_portfolio > backup_$(date +%F).sql
   ```
2. **Media Library Storage**:
   Regularly archive the contents of `storage/app/public/` where uploaded project showcases, avatars, and certificate media reside.
3. **Environment Security**:
   Encrypt the environment file in CI/CD using Laravel's native encryption:
   ```bash
   php artisan env:encrypt --key=your-encryption-key
   ```

---

## Common Artisan Commands

```bash
# Run automated tests
php artisan test --compact

# Code style formatting (Laravel Pint)
vendor/bin/pint --format agent

# Clear application cache
php artisan cache:clear

# Re-index Scout search records
php artisan scout:import "App\Models\Project"
php artisan scout:import "App\Models\Experience"
php artisan scout:import "App\Models\Skill"
php artisan scout:import "App\Models\Article"
```

---

## License

This project is licensed under the [MIT License](LICENSE).
