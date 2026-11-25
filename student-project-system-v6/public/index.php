<?php
declare(strict_types=1);
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/queries.php';

$stats = project_stats(spms_pdo());
$title = 'Home';
require __DIR__ . '/../includes/header.php';
?>
<p class="eyebrow">Student Project Management System</p>
<h1>Make student work visible.</h1>
<p class="lede">A simple home for project proposals, supervision, and progress.
  Right now the system holds <strong><?= (int)$stats['total'] ?></strong> projects,
  <strong><?= (int)$stats['completed'] ?></strong> of them completed.</p>
<a class="button" href="projects.php">Browse projects</a>
<?php require __DIR__ . '/../includes/footer.php'; ?>
