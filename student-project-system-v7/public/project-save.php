<?php
declare(strict_types=1);
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/queries.php';
require __DIR__ . '/../includes/validation.php';
require __DIR__ . '/../includes/flash.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: projects.php', true, 303);
    exit;
}

$id = (int)($_POST['id'] ?? 0);
[$data, $errors] = validate_project($_POST);

if ($errors) {
    flash_set('errors', array_values($errors));
    $_SESSION['_old'] = $_POST;
    header('Location: ' . ($id ? "project-form.php?id={$id}" : 'project-form.php'), true, 303);
    exit;
}

if ($id) {
    update_project(spms_pdo(), $id, $data);
    flash_set('success', 'Project updated.');
} else {
    create_project(spms_pdo(), $data);
    flash_set('success', 'Project created.');
}

header('Location: projects.php', true, 303);
exit;
