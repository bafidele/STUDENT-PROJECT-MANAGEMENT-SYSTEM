<?php
declare(strict_types=1);

namespace App\Models;

use App\Config\Database;

final class Category {
    public static function all(): array {
        return Database::pdo()->query('SELECT id, name FROM categories ORDER BY name')->fetchAll();
    }
}
