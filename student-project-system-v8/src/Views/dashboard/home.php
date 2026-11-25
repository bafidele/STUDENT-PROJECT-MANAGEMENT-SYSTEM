<p class="eyebrow">Student Project Management System</p>
<h1>Make student work visible.</h1>
<p class="lede">A simple home for project proposals, supervision, and progress.
  Right now the system holds <strong><?= (int)$stats['total'] ?></strong> projects,
  <strong><?= (int)$stats['completed'] ?></strong> of them completed.</p>
<a class="button" href="<?= \App\Support\Url::to('/projects.php') ?>">Browse projects</a>
