<?php
declare(strict_types=1);

namespace App\Models;

use App\Config\Database;

final class Supervisor {
    public static function all(): array {
        return Database::pdo()->query('SELECT id, full_name FROM supervisors ORDER BY full_name')->fetchAll();
    }
}
