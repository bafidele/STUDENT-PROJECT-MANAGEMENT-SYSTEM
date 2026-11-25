<?php
declare(strict_types=1);

namespace App\Support;

final class Logger {
    public static function write(string $level, string $message, array $context = []): void {
        $dir = dirname(__DIR__, 2) . '/logs';
        if (!is_dir($dir)) @mkdir($dir, 0775, true);
        $line = sprintf("[%s] %s %s %s\n", date('c'), strtoupper($level), $message, json_encode($context));
        @file_put_contents($dir . '/app.log', $line, FILE_APPEND);
    }
}
