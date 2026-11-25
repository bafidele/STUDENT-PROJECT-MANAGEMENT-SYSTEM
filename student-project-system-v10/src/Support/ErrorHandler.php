<?php
declare(strict_types=1);

namespace App\Support;

use Throwable;

final class ErrorHandler {
    public static function register(): void {
        ini_set('display_errors', '0');
        ini_set('log_errors', '1');

        set_exception_handler(function (Throwable $e): void {
            Logger::write('error', $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'uri'  => $_SERVER['REQUEST_URI'] ?? '',
            ]);

            if (!headers_sent()) http_response_code(500);

            if (str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/api/')) {
                if (!headers_sent()) header('Content-Type: application/json');
                echo json_encode(['ok' => false, 'error' => 'Server error']);
            } else {
                echo '<h1>Something went wrong</h1><p>Please try again later.</p>';
            }
        });
    }
}
