# Pantheraa Space — Digital Marketing Agency Website

A fast, animated, SEO/AEO/GEO‑optimized marketing website for **Pantheraa Space** ("Digital Panther").
Built to look premium on phone and desktop, convert visitors into leads, and rank in both classic
search **and** AI answer engines.

## ✨ Stack

| Layer | Tech |
|---|---|
| Backend | **Laravel 12** (PHP 8.2+) |
| Interactivity | **Livewire 4** (single‑file components) + **Alpine.js** (bundled with Livewire) |
| Styling | **Tailwind CSS v4** (CSS‑first `@theme` config) |
| Animation | **Motion One** (`motion` / motion.dev) — the vanilla‑JS engine from the creator of Framer Motion. *Framer Motion itself is React‑only and cannot run in a Livewire/Blade app, so Motion One is used to get the same spring & scroll animations.* |
| Build | **Vite 7** |
| Database | **SQLite** by default (zero‑config). Switch to MySQL for production — see below. |

## 🚀 What's included

- **Responsive, dark, brand‑themed UI** derived from the logo (black panther, red + blue "eyes" → the signature `flame → volt` gradient).
- **Pages**: Home (hero, stats, services, process, work, testimonials, FAQ, CTA), Services, About, Contact.
- **Livewire components**: `contact-form` (validates + stores leads in DB) and `newsletter-form`.
- **SEO / AEO / GEO**:
  - Dynamic `<title>`, meta description, canonical, Open Graph + Twitter cards per page.
  - **JSON‑LD structured data**: `Organization`, `ProfessionalService` (LocalBusiness), `WebSite`, `Service` list, `FAQPage`, `BreadcrumbList`, `ContactPage` — the signals AI engines (ChatGPT, Gemini, Google AI Overviews) and Google use to understand & cite the brand.
  - Dynamic `/sitemap.xml` and `/robots.txt`.
  - Semantic HTML, fast Core‑Web‑Vitals‑friendly build, `prefers-reduced-motion` support, a11y skip‑link.
- **Animations**: scroll reveals, staggered grids, animated counters, magnetic buttons, scroll‑progress bar — all re‑initialised after Livewire SPA navigation.
- **Tests**: feature tests covering page loads, schema output, contact form validation/persistence, and newsletter signup.

> **Note on ASO:** "App Store Optimization" is a *service the agency offers* (featured on the site), not a website meta‑tag concept. It's presented as a service card + included in the structured data.

## 🧩 Where to edit content

Almost everything lives in one file:

```
config/site.php   ← brand name, NAP (address/phone), socials, services, stats, process, testimonials, FAQs
```

Both the visible pages **and** the JSON‑LD schema are generated from it, so editing once updates everything.

The logo lives at `public/images/logo.jpeg` (used for favicon + social share image).
The navbar/footer use a lightweight on‑brand SVG mark (`resources/views/components/brand.blade.php`)
because the supplied JPEG is black‑on‑white and would show a white box on the dark theme — drop a
transparent PNG in and swap it there if you prefer the full lockup.

## 🛠️ Local development (XAMPP / Windows)

PHP and Node are required. With XAMPP, PHP lives at `D:\xampp2\php\php.exe`.

```bash
# 1. Install dependencies (first time only)
php composer.phar install      # or: composer install
npm install

# 2. Environment
copy .env.example .env         # cp on macOS/Linux
php artisan key:generate

# 3. Database (SQLite, zero‑config)
php artisan migrate

# 4a. Dev mode — Vite hot reload (run BOTH in separate terminals)
npm run dev
php artisan serve              # http://localhost:8000

# 4b. …or build once and just serve
npm run build
php artisan serve
```

Open **http://localhost:8000**.

## 🧪 Tests

```bash
php artisan test
```

## 🌐 Deployment

This is a standard Laravel app — deploy it like any Laravel project.

**Build assets before deploying:**
```bash
npm run build          # outputs to public/build
```

**Production `.env` essentials:**
```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com     # used for canonical, sitemap, OG & schema URLs
```

**Optimize on the server:**
```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
```

### Apache (XAMPP / cPanel)
Point the **document root at `public/`** (never the project root). Example virtual host:

```apache
<VirtualHost *:80>
    ServerName pantheraa.local
    DocumentRoot "D:/xampp2/htdocs/panthera/public"
    <Directory "D:/xampp2/htdocs/panthera/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
`mod_rewrite` must be enabled (the included `public/.htaccess` handles pretty URLs, `sitemap.xml`, `robots.txt`).

### MySQL (recommended for production)
Create a database, then in `.env`:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pantheraa
DB_USERNAME=root
DB_PASSWORD=
```
Run `php artisan migrate --force`.

### Email for contact leads
Leads are stored in the `contacts` table. To also email them, set SMTP creds in `.env`
(`MAIL_*`) and uncomment the `Mail::to(...)` line in
`resources/views/components/⚡contact-form.blade.php`.

## 📂 Project map

```
config/site.php                         all editable content + NAP
resources/css/app.css                   Tailwind v4 theme + brand design system
resources/js/app.js                     Motion One animation engine
resources/views/
  components/app-layout.blade.php        master layout (SEO meta + assets)
  components/navbar|footer|brand|icon    UI components
  components/⚡contact-form.blade.php     Livewire: contact (DB + validation)
  components/⚡newsletter-form.blade.php  Livewire: newsletter
  partials/schema.blade.php              JSON-LD structured data
  sections/*.blade.php                   homepage sections
  home|services|about|contact.blade.php  pages
  sitemap.blade.php                      XML sitemap
routes/web.php                           routes + sitemap + robots
tests/Feature/MarketingSiteTest.php      feature tests
```

---
Crafted with Laravel, Livewire & Motion. 🐾
