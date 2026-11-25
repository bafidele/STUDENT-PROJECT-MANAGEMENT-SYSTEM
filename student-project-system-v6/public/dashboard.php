<?php
declare(strict_types=1);
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/queries.php';

$stats = project_stats(spms_pdo());
$title = 'Dashboard';
require __DIR__ . '/../includes/header.php';
?>
<p class="eyebrow">Overview</p>
<h1>Dashboard</h1>
<section class="card-grid">
  <article class="card"><span class="eyebrow">Total</span><p class="stat"><?= (int)$stats['total'] ?></p></article>
  <article class="card"><span class="eyebrow">Proposed</span><p class="stat"><?= (int)$stats['proposed'] ?></p></article>
  <article class="card"><span class="eyebrow">In progress</span><p class="stat"><?= (int)$stats['in_progress'] ?></p></article>
  <article class="card"><span class="eyebrow">Completed</span><p class="stat"><?= (int)$stats['completed'] ?></p></article>
</section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
