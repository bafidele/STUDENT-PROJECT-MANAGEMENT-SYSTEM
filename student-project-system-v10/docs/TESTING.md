# Testing

Start the app, then work through the matrix. The curl examples use a cookie jar because the CSRF token is tied to the session:

```
curl -s -c jar -b jar http://localhost:8000/projects.php -o /dev/null
TOKEN=$(curl -s -c jar -b jar http://localhost:8000/projects.php | grep -o 'csrf-token" content="[0-9a-f]*' | sed 's/.*"//')
```

| # | Test | Expected |
|---|---|---|
| 1 | `GET /` and `/dashboard.php` | Totals 6 / 2 proposed / 2 in progress / 2 completed |
| 2 | `GET /projects.php` | 6 cards with student, supervisor and category names |
| 3 | `GET /projects.php?q=library` | 1 card |
| 4 | `GET /projects.php?status=Completed` | 2 cards |
| 5 | Create a project with valid data | 303 to `/projects.php`, flash "Project created.", card appears |
| 6 | Create with a 2-character title | 303 back to the form, errors shown, old values kept |
| 7 | Edit a project | Form pre-filled, save, list updated |
| 8 | Delete a project | Confirm dialog, card gone, flash "Project deleted." |
| 9 | POST to `/project-save.php` or `/project-delete.php` without a token | 419, nothing changed |
| 10 | `GET /project-delete.php?id=1` | 303 to `/projects.php`, nothing deleted |
| 11 | Type in the search box | Network tab shows `/api/projects?q=…`, grid updates, no reload |
| 12 | Rename the API path in `projects-live.js` | Error text appears in `#async-status` |
| 13a | `curl -X POST -d '{}' /api/projects/create` (no token) | 419 |
| 13b | Same with `-H "X-CSRF-Token: $TOKEN" -b jar` | 422 with one message per field |
| 14 | View source of any page; break the DB password | No PHP, no stack trace; generic "Something went wrong" |
| 15 | Look in `logs/app.log` after test 14 | One line per error with message, file, line and URI |
