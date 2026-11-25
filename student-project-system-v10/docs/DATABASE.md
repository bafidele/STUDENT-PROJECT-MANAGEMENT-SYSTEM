# Database

Four tables, created by `database/schema.sql`.

| Table | Columns |
|---|---|
| `students` | id, full_name, reg_number (unique), email (unique) |
| `supervisors` | id, full_name, email (unique) |
| `categories` | id, name (unique) |
| `projects` | id, title, description, status, student_id, supervisor_id, category_id, created_at, updated_at |

`projects.status` is an ENUM: `Proposed`, `In progress`, `Completed`, `Archived`.

Each project has exactly one student, one supervisor and one category, enforced by foreign keys (`ON UPDATE CASCADE ON DELETE RESTRICT`), so a student, supervisor or category that still has projects cannot be deleted.

The data is normalised: a student's name is stored once and projects point to it by id. Renaming a supervisor is one UPDATE, and no project can ever show a misspelt copy of that name.
