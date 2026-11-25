<?php
declare(strict_types=1);

namespace App\Support;

final class View {
    public static function render(string $template, array $data = []): void {
        extract($data, EXTR_SKIP);
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/' . $template . '.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public static function e(mixed $v): string {
        return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
    }
}
