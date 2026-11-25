<?php
declare(strict_types=1);
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/queries.php';
require __DIR__ . '/../includes/flash.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: projects.php', true, 303);
    exit;
}

$id = (int)($_POST['id'] ?? 0);
if ($id > 0) {
    delete_project(spms_pdo(), $id);
    flash_set('success', 'Project deleted.');
}
header('Location: projects.php', true, 303);
exit;
