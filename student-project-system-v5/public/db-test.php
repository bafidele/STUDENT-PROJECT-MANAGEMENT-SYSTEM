<?php
declare(strict_types=1);
require __DIR__ . '/../config/database.php';

$pdo = spms_pdo();
header('Content-Type: text/plain');
foreach (['students', 'supervisors', 'categories', 'projects'] as $table) {
    echo $table . ': ' . (int)$pdo->query("SELECT COUNT(*) FROM {$table}")->fetchColumn() . "\n";
}
