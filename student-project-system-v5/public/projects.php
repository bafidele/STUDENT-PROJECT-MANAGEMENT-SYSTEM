<?php
declare(strict_types=1);
require __DIR__ . '/../includes/data.php';
$title = 'Projects';
require __DIR__ . '/../includes/header.php';
?>
<p class="eyebrow">Portfolio</p>
<h1>Projects</h1>

<section id="project-grid" class="card-grid">
  <?php foreach (spms_projects() as $p): ?>
    <article class="card project-card" data-status="<?= htmlspecialchars($p['status']) ?>">
      <span class="eyebrow"><?= htmlspecialchars($p['status']) ?></span>
      <h2><?= htmlspecialchars($p['title']) ?></h2>
      <p><?= htmlspecialchars($p['description']) ?></p>
    </article>
  <?php endforeach; ?>
</section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
