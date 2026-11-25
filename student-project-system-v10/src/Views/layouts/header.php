<?php use App\Support\Csrf;
use App\Support\View; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?= View::e(Csrf::token()) ?>">
  <title><?= View::e($title ?? 'SPMS') ?> · SPMS</title>
  <link rel="stylesheet" href="<?= \App\Support\Url::to('/assets/css/style.css') ?>?v=bookman-old-style-1">
  <script>window.SPMS = window.SPMS || {}; window.SPMS.baseUrl = <?= json_encode(\App\Support\Url::base(), JSON_UNESCAPED_SLASHES) ?>; window.SPMS.url = path => window.SPMS.baseUrl + (String(path).startsWith('/') ? String(path) : '/' + String(path));</script>
</head>
<body>
  <header class="site-header">
    <a class="brand" href="<?= \App\Support\Url::to('/') ?>">SPMS</a>
    <nav aria-label="Primary">
      <a href="<?= \App\Support\Url::to('/') ?>">Home</a>
      <a href="<?= \App\Support\Url::to('/projects.php') ?>">Projects</a>
      <a href="<?= \App\Support\Url::to('/dashboard.php') ?>">Dashboard</a>
      <a href="<?= \App\Support\Url::to('/register.php') ?>">Register</a>
    </nav>
  </header>
  <main class="container">
