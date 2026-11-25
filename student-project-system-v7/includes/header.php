<?php
declare(strict_types=1);
$title = $title ?? 'SPMS';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title) ?> · SPMS</title>
  <link rel="stylesheet" href="assets/css/style.css?v=bookman-old-style-1">
</head>
<body>
  <header class="site-header">
    <a class="brand" href="index.php">SPMS</a>
    <nav aria-label="Primary">
      <a href="index.php">Home</a>
      <a href="projects.php">Projects</a>
      <a href="dashboard.php">Dashboard</a>
      <a href="register.php">Register</a>
    </nav>
  </header>
  <main class="container">
