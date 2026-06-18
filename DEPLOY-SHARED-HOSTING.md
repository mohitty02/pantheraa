# Deploying Pantheraa Space to shared hosting (no SSH / no npm / no Composer)

This build is ready for a **PHP + WordPress style shared host (cPanel)**. Everything
that normally needs a terminal has been pre-done locally:

- **Assets are pre-built** (`build/`) → no `npm` needed on the server.
- **Dependencies are vendored** (`pantheraa/vendor/`) → no `composer` needed.
- **Uploads use a plain folder** (`uploads/`) → no `php artisan storage:link` needed.
- **Database ships as an SQL file** (`pantheraa/database/panthera.sql`) → import via phpMyAdmin, no `migrate` needed.

## Folder layout (already structured for you)

```
public_html/                 ← your domain's web root (this folder's contents)
├── index.php                ← front controller → loads ../pantheraa
├── .htaccess                ← pretty URLs
├── favicon.ico
├── build/                   ← compiled CSS/JS (Vite)
├── images/                  ← logo etc.
├── uploads/                 ← (created automatically when you upload images in admin)
└── pantheraa/               ← the Laravel app (blocked from the web by its .htaccess)
    ├── app/ bootstrap/ config/ database/ resources/ routes/ storage/ vendor/
    ├── .env                 ← you create this on the server
    └── database/panthera.sql ← import this into your DB
```

> Security: `pantheraa/` is inside the web root for convenience, but its own
> `.htaccess` denies all direct web access. Keep that file.

---

## Step-by-step

### 1. Make the upload ZIP (on your PC)
Zip the **contents of this `panthera` folder**, but **exclude**:
- `pantheraa/node_modules/`  (huge, not needed — assets are already built)
- `pantheraa/.git/`, `pantheraa/tests/` (optional)
- `pantheraa/database/database.sqlite` (old local DB, not used)

Everything else (including `pantheraa/vendor/` and `build/`) **must** be included.

### 2. Upload & extract
In **cPanel → File Manager**, open **`public_html`** (or your domain's docroot),
upload the ZIP, and **Extract** it there. You should end up with `index.php`,
`build/`, `images/`, and `pantheraa/` directly inside `public_html`.

### 3. Create the database & import data
1. **cPanel → MySQL® Databases**: create a database + a user, add the user to the
   database with **All Privileges**. Note the final names (cPanel prefixes them,
   e.g. `cpaneluser_panthera`).
2. **cPanel → phpMyAdmin**: select that database → **Import** tab →
   choose **`pantheraa/database/panthera.sql`** → **Go**.
   (All tables + your content + the admin user import in one shot.)

### 4. Configure the environment
In File Manager, go to **`pantheraa/`**:
1. Rename **`.env.production.example`** → **`.env`** (enable "show hidden files").
2. Edit `.env` and set:
   - `APP_URL=https://your-domain.com`
   - `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` (from step 3)
   - leave `APP_KEY` exactly as-is, `APP_ENV=production`, `APP_DEBUG=false`.

### 5. PHP version & extensions
**cPanel → Select PHP Version**: choose **PHP 8.2 or 8.3**, and make sure these
extensions are enabled: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`,
`ctype`, `json`, `fileinfo`, `curl`, `bcmath`.

### 6. Folder permissions
Make these **writable** (cPanel File Manager → right-click → Change Permissions → `755`,
or `775` if needed):
- `pantheraa/storage/` (and everything inside)
- `pantheraa/bootstrap/cache/`

### 7. Go live ✅
- Visit **https://your-domain.com** — the site should load.
- Admin: **https://your-domain.com/admin/login** → `admin@pantheraa.space` / `panthera123`
  → **change the password immediately** (and update the email in Settings).
- Submit the sitemap in Google Search Console: **https://your-domain.com/sitemap.xml**

---

## Updating the site later
- **Content** (services, learnings, settings, leads…) → just use **/admin**. No re-upload.
- **Code/design changes** → on your PC run `npm run build` inside `pantheraa/`, then copy
  the new `pantheraa/public/build/` contents over the web-root `build/` folder and
  re-upload `build/` (+ any changed `pantheraa/` files).

## Troubleshooting a 500 error
1. Temporarily set `APP_DEBUG=true` in `pantheraa/.env` to see the real error.
2. Check **`pantheraa/storage/logs/laravel.log`**.
3. 99% of the time it's: `bootstrap/cache` or `storage` not writable, wrong DB
   credentials, or PHP < 8.2. Fix and reload.
4. If you see a stale-path error, delete any files inside `pantheraa/bootstrap/cache/`
   (NOT the folder) — Laravel regenerates them.
5. Set `APP_DEBUG=false` again once it works.
