# ABRM Management

Minimal page-based scaffold for the ABRM Management suite. The project uses plain PHP (8+) with PDO, MinIO-ready helpers, and folder-per-page modules. Each module exposes a small JSON API for AJAX calls and includes dedicated JS/CSS files.

## Structure
- `config/` global configuration (database, MinIO, security).
- `core/` shared helpers for auth, CSRF, database, permissions, activity logging, exports, notifications, and MinIO uploads.
- `public/` page folders with `index.php`, `api.php`, `style.css`, and `script.js`. Shared layout lives in `public/includes/` and assets in `public/assets/`.
- `storage/` temp/log directories used by exports and mock MinIO uploads.

## Getting started
1. Adjust credentials in `config/config.php` for your database and MinIO endpoint.
2. Create required tables (`users`, `permissions`, `role_permissions`, `notifications`, etc.).
3. Point your web server to `public/` as the document root.
4. Access `/public/login` to sign in and explore the stubbed modules.
