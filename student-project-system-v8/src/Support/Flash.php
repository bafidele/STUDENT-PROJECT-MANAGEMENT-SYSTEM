<?php
declare(strict_types=1);

namespace App\Support;

final class Flash {
    public static function set(string $key, mixed $value): void { $_SESSION['_flash'][$key] = $value; }

    public static function get(string $key, mixed $default = null): mixed {
        $value = $_SESSION['_flash'][$key] ?? $default;
        unset($_SESSION['_flash'][$key]);
        return $value;
    }

    public static function old(string $key, string $default = ''): string {
        return (string)($_SESSION['_old'][$key] ?? $default);
    }

    public static function keepOld(array $input): void { $_SESSION['_old'] = $input; }
    public static function clearOld(): void { unset($_SESSION['_old']); }
}
