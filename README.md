# ABRM Management

Minimal page-based scaffold for the ABRM Management suite. The project uses plain PHP (8+) with PDO, MinIO-ready helpers, and folder-per-page modules. Each module exposes a small JSON API for AJAX calls and includes dedicated JS/CSS files.

## Structure
- `config/` global configuration (database, MinIO, security).
- `core/` shared helpers for auth, CSRF, database, permissions, activity logging, exports, notifications, and MinIO uploads.
- `public/` page folders with `index.php`, `api.php`, `style.css`, and `script.js`. Shared layout lives in `public/includes/` and assets in `public/assets/`.
- `storage/` temp/log directories used by exports and mock MinIO uploads.

## Getting started
1. Install Composer (if you do not already have it) and install PHP dependencies:
   ```bash
   composer install
   ```
   This pulls Dompdf (PDF), PhpSpreadsheet (Excel), AWS SDK for MinIO S3, and QR code generation libraries.
2. Adjust credentials in `config/config.php` for your database and MinIO endpoint.
3. Import the bootstrap schema from `config/schema.sql` to create all tables and seed a default `owner@example.com / password` app_owner account.
4. Serve the app with `public/` as the document root. For quick local testing, use PHP's built-in server:
   ```bash
   php -S 0.0.0.0:8000 -t public
   ```
   If you see a 404 from Apache or another web server, double-check that the document root points to the `public/` directory (e.g., `http://localhost/public/login` when using the built-in server above).
5. Access `/login` to sign in and explore the modules using the seeded owner account, then create roles and users as needed.
