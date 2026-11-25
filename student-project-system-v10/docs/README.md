# Student Project Management System (SPMS)

A multi-tier PHP + MySQL web application for managing student projects: list, search, create, edit, view and delete projects, with a dashboard and a JSON API.

## Requirements
PHP 8.1+ with `pdo_mysql` and `mbstring`, and MySQL or MariaDB.

## Install
1. Create the database `spms` and run `database/schema.sql`, then `database/seed.sql`.
2. Copy `.env.example` to `.env` and set `DB_USER` and `DB_PASS`.
3. Make sure `logs/` is writable.

## Run
```
php -S localhost:8000 -t public public/index.php
```
Open http://localhost:8000/. The second `public/index.php` is the router script: it sends every request to the front controller.

## Routes
| URL | Purpose |
|---|---|
| `/` | Home with project totals |
| `/projects.php` | List, search, filter, delete |
| `/project-show.php?id=` | One project |
| `/project-form.php[?id=]` | New / edit form |
| `/project-save.php` | POST: create or update |
| `/project-delete.php` | POST: delete |
| `/dashboard.php` | Counts by status |
| `/register.php`, `/process-registration.php` | Registration form and its POST handler |
| `/api/projects`, `/api/projects/create`, `/api/projects/delete`, `/api/dashboard` | JSON API |
