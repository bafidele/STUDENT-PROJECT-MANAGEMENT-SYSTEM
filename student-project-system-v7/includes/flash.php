<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) session_start();

function flash_set(string $key, mixed $value): void {
    $_SESSION['_flash'][$key] = $value;
}
function flash_get(string $key, mixed $default = null): mixed {
    $value = $_SESSION['_flash'][$key] ?? $default;
    unset($_SESSION['_flash'][$key]);
    return $value;
}
function old(string $key, string $default = ''): string {
    return (string)($_SESSION['_old'][$key] ?? $default);
}
function old_clear(): void { unset($_SESSION['_old']); }
