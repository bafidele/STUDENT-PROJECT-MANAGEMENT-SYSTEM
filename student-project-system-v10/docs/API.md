# JSON API

Every response is an envelope: `{ "ok": true, "data": ... }` or `{ "ok": false, "error": "..." }` / `{ "ok": false, "errors": { field: message } }`.

| Method | Path | Body | Success | Errors |
|---|---|---|---|---|
| GET | `/api/projects?q=&status=` | none | 200 `{ok, data:{projects}}` | 500 |
| POST | `/api/projects/create` | JSON project fields | 201 `{ok, data:{id}}` | 405, 419, 422 |
| POST | `/api/projects/delete` | `{"id": 1}` | 200 `{ok, data:{id}}` | 405, 419, 422 |
| GET | `/api/dashboard` | none | 200 `{ok, data:{total, proposed, in_progress, completed}}` | 500 |

Project fields: `title`, `description`, `status`, `student_id`, `supervisor_id`, `category_id`.

Both POST endpoints need the header `X-CSRF-Token` with the token from the page's `<meta name="csrf-token">`, and the session cookie. Without it they answer 419 before looking at the body.
