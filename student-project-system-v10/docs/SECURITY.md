# Security checklist

- [x] Server-side validation of every field (`ProjectValidator`, registration checks)
- [x] Output escaped with `View::e()` (`htmlspecialchars`) in every view; `escapeHtml()` in JavaScript
- [x] Prepared statements for all SQL, `ATTR_EMULATE_PREPARES = false`
- [x] A named placeholder is used once per query (required by native prepares)
- [x] CSRF token on every state-changing request: forms, registration, and the API (`X-CSRF-Token`)
- [x] CSRF check runs after the method check, so a plain GET is redirected, not rejected
- [x] Deletes and saves accept POST only
- [x] Session cookie is `HttpOnly` and `SameSite=Lax` (`Secure` when served over HTTPS)
- [x] Security headers: `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`
- [x] `display_errors` off; errors go to `logs/app.log`; users see a generic message
- [x] `logs/`, `src/`, `config` and `.env` live outside `public/` and cannot be requested
