<?php use App\Support\View; ?>
<p class="eyebrow">Portfolio</p>
<h1>Projects</h1>

<?php if (!empty($success)): ?>
  <p class="success"><?= View::e($success) ?></p>
<?php endif; ?>

<form id="project-filters" method="get" class="toolbar">
  <input id="project-search" type="search" name="q" placeholder="Search projects…" value="<?= View::e($q) ?>" aria-label="Search projects">
  <select id="status-filter" name="status" aria-label="Filter by status">
    <option value="">All statuses</option>
    <?php foreach (['Proposed', 'In progress', 'Completed', 'Archived'] as $s): ?>
      <option <?= $status === $s ? 'selected' : '' ?>><?= $s ?></option>
    <?php endforeach; ?>
  </select>
  <button class="button">Filter</button>
  <a class="button" href="<?= \App\Support\Url::to('/project-form.php') ?>">+ New project</a>
</form>

<p class="count">Showing <strong id="project-count"><?= count($projects) ?></strong> project(s)</p>
<p id="async-status" aria-live="polite"></p>

<section id="project-grid" class="card-grid">
  <?php foreach ($projects as $p): ?>
    <article class="card project-card" data-status="<?= View::e($p['status']) ?>">
      <span class="eyebrow"><?= View::e($p['status']) ?></span>
      <h2><a href="<?= \App\Support\Url::to('/project-show.php') ?>?id=<?= (int)$p['id'] ?>"><?= View::e($p['title']) ?></a></h2>
      <p><?= View::e($p['description']) ?></p>
      <p class="meta">
        <strong>Student:</strong> <?= View::e($p['student_name']) ?><br>
        <strong>Supervisor:</strong> <?= View::e($p['supervisor_name']) ?><br>
        <strong>Category:</strong> <?= View::e($p['category_name']) ?>
      </p>
      <div class="card-actions">
        <a class="button-ghost" href="<?= \App\Support\Url::to('/project-form.php') ?>?id=<?= (int)$p['id'] ?>">Edit</a>
        <form method="post" action="<?= \App\Support\Url::to('/project-delete.php') ?>" class="js-delete-form"
              onsubmit="return confirm('Delete this project?');">
          <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
          <button class="button-danger">Delete</button>
        </form>
      </div>
    </article>
  <?php endforeach; ?>
</section>

<script src="<?= \App\Support\Url::to('/assets/js/api.js') ?>"></script>
<script src="<?= \App\Support\Url::to('/assets/js/projects-live.js') ?>"></script>
