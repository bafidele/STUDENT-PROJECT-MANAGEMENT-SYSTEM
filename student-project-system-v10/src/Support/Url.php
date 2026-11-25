<?php
declare(strict_types=1);

namespace App\Support;

final class Url {
    public static function base(): string {
        if (PHP_SAPI === 'cli-server') return '';

        $scriptName = str_replace('\\', '/', (string)($_SERVER['SCRIPT_NAME'] ?? ''));
        $directory = rtrim(dirname($scriptName), '/.');
        return ($directory === '' || $directory === '.') ? '' : $directory;
    }

    public static function to(string $path): string {
        return self::base() . '/' . ltrim($path, '/');
    }
}
