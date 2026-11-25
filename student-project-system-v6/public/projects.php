<?php
declare(strict_types=1);
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/queries.php';

$search = trim((string)($_GET['q'] ?? ''));
$status = trim((string)($_GET['status'] ?? ''));

$projects = project_rows(spms_pdo(), $search, $status);

$title = 'Projects';
require __DIR__ . '/../includes/header.php';
?>
<p class="eyebrow">Portfolio</p>
<h1>Projects</h1>

<form method="get" class="toolbar">
  <input type="search" name="q" placeholder="Search projects…"
         value="<?= htmlspecialchars($search) ?>" aria-label="Search projects">
  <select name="status" aria-label="Filter by status">
    <option value="">All statuses</option>
    <?php foreach (['Proposed', 'In progress', 'Completed', 'Archived'] as $s): ?>
      <option <?= $status === $s ? 'selected' : '' ?>><?= $s ?></option>
    <?php endforeach; ?>
  </select>
  <button class="button">Filter</button>
</form>

<p class="count">Showing <strong><?= count($projects) ?></strong> project(s)</p>

<section class="card-grid">
  <?php foreach ($projects as $p): ?>
    <article class="card project-card" data-status="<?= htmlspecialchars($p['status']) ?>">
      <span class="eyebrow"><?= htmlspecialchars($p['status']) ?></span>
      <h2><?= htmlspecialchars($p['title']) ?></h2>
      <p><?= htmlspecialchars($p['description']) ?></p>
      <p class="meta">
        <strong>Student:</strong> <?= htmlspecialchars($p['student_name']) ?><br>
        <strong>Supervisor:</strong> <?= htmlspecialchars($p['supervisor_name']) ?><br>
        <strong>Category:</strong> <?= htmlspecialchars($p['category_name']) ?>
      </p>
    </article>
  <?php endforeach; ?>
</section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
