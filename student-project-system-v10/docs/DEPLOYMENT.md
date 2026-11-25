# Deployment

1. Point the web server's document root at `public/` only. With Apache, route unknown paths to `public/index.php` (`FallbackResource /index.php`); with Nginx, `try_files $uri /index.php`.
2. Provide the database settings as environment variables (`DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`) or in a `.env` file next to `src/`.
3. Run `database/schema.sql` then `database/seed.sql` on the production database (skip the seed for real data).
4. Make `logs/` writable by the web server user (`chmod 775 logs`).
5. Keep `display_errors = Off` in `php.ini`.
6. Serve over HTTPS so the session cookie gets the `Secure` flag.
