<?php
declare(strict_types=1);
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/queries.php';
require __DIR__ . '/../includes/flash.php';

$search = trim((string)($_GET['q'] ?? ''));
$status = trim((string)($_GET['status'] ?? ''));

$projects = project_rows(spms_pdo(), $search, $status);

$title = 'Projects';
require __DIR__ . '/../includes/header.php';
?>
<p class="eyebrow">Portfolio</p>
<h1>Projects</h1>

<?php if ($msg = flash_get('success')): ?>
  <p class="success"><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>

<p><a class="button" href="project-form.php">+ New project</a></p>

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
      <h2><a href="project-show.php?id=<?= (int)$p['id'] ?>"><?= htmlspecialchars($p['title']) ?></a></h2>
      <p><?= htmlspecialchars($p['description']) ?></p>
      <p class="meta">
        <strong>Student:</strong> <?= htmlspecialchars($p['student_name']) ?><br>
        <strong>Supervisor:</strong> <?= htmlspecialchars($p['supervisor_name']) ?><br>
        <strong>Category:</strong> <?= htmlspecialchars($p['category_name']) ?>
      </p>
      <div class="card-actions">
        <a class="button-ghost" href="project-form.php?id=<?= (int)$p['id'] ?>">Edit</a>
        <form method="post" action="project-delete.php"
              onsubmit="return confirm('Delete this project?');">
          <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
          <button class="button-danger">Delete</button>
        </form>
      </div>
    </article>
  <?php endforeach; ?>
</section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
