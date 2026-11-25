<?php
declare(strict_types=1);

namespace App\Models;

use App\Config\Database;

final class Student {
    public static function all(): array {
        return Database::pdo()->query('SELECT id, full_name FROM students ORDER BY full_name')->fetchAll();
    }
}
