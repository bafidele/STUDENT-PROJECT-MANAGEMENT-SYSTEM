<?php
declare(strict_types=1);

namespace App\Support;

final class Csrf {
    public static function token(): string {
        if (empty($_SESSION['_csrf'])) $_SESSION['_csrf'] = bin2hex(random_bytes(32));
        return $_SESSION['_csrf'];
    }

    public static function check(?string $token): bool {
        $expected = $_SESSION['_csrf'] ?? '';
        return is_string($token) && $token !== '' && $expected !== '' && hash_equals($expected, $token);
    }

    public static function require(): void {
        $sent = $_POST['_csrf'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null);
        if (!self::check(is_string($sent) ? $sent : null)) {
            http_response_code(419);
            exit('CSRF token invalid');
        }
    }
}
