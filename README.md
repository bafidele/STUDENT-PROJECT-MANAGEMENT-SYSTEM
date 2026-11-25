# SPMS: ten versions

## Open through XAMPP

Place this folder under `C:\xampp\htdocs\spms-whole`, start Apache and MySQL in the XAMPP Control Panel, then open:

| Version | URL |
|---|---|
| v1 | http://localhost/spms-whole/student-project-system-v1/ |
| v2 | http://localhost/spms-whole/student-project-system-v2/ |
| v3 | http://localhost/spms-whole/student-project-system-v3/ |
| v4 | http://localhost/spms-whole/student-project-system-v4/public/ |
| v5 | http://localhost/spms-whole/student-project-system-v5/public/ |
| v6 | http://localhost/spms-whole/student-project-system-v6/public/ |
| v7 | http://localhost/spms-whole/student-project-system-v7/public/ |
| v8 | http://localhost/spms-whole/student-project-system-v8/public/ |
| v9 | http://localhost/spms-whole/student-project-system-v9/public/ |
| v10 | http://localhost/spms-whole/student-project-system-v10/public/ |

For versions 5–10, the local Apache config points to the isolated database `spms_versions_test_20261124`. To recreate it in phpMyAdmin, create that database, then import `student-project-system-v10/database/schema.sql` followed by `student-project-system-v10/database/seed.sql`. The v5–v10 schemas are compatible. The existing `spms` and `student_project_system` databases are left untouched. Replace the local database settings in each version's `public/.htaccess` if you want to use another database. The default XAMPP credentials are `root` with a blank password; set a password and update `DB_PASS` for a secured local setup.

## Run without Apache

| Version | Command from inside the version folder |
|---|---|
| v1, v2, v3 | `python3 -m http.server 8000` |
| v4, v5, v6, v7 | `php -S localhost:8000 -t public` |
| v8, v9, v10 | `php -S localhost:8000 -t public public/index.php` |

From v5 on, database settings can also be provided with `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASS`. Version 10 additionally reads a `.env` file.
