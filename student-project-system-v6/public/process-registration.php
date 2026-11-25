<?php
declare(strict_types=1);
session_start();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: register.php', true, 303);
    exit;
}

$name  = trim((string)($_POST['name']  ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$errors = [];

if (mb_strlen($name) < 3)                       $errors[] = 'Enter your name (at least 3 characters).';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email address.';

if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old']    = ['name' => $name, 'email' => $email];
    header('Location: register.php', true, 303);
    exit;
}

$_SESSION['flash'] = 'Registration accepted for ' . $name . '.';
header('Location: register.php', true, 303);
exit;
