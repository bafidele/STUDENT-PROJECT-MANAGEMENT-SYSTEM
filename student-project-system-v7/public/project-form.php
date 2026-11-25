<?php
declare(strict_types=1);
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/queries.php';
require __DIR__ . '/../includes/flash.php';

$pdo     = spms_pdo();
$id      = (int)($_GET['id'] ?? 0);
$project = $id ? find_project($pdo, $id) : null;

if ($id && !$project) { http_response_code(404); exit('Project not found.'); }

$errors = flash_get('errors', []);
$title  = $project ? 'Edit project' : 'New project';
require __DIR__ . '/../includes/header.php';
?>
<p class="eyebrow"><?= $project ? 'Edit' : 'Create' ?></p>
<h1><?= htmlspecialchars($title) ?></h1>

<?php if ($errors): ?>
  <ul class="error-list">
    <?php foreach ($errors as $msg): ?><li><?= htmlspecialchars($msg) ?></li><?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="post" action="project-save.php">
  <?php if ($project): ?>
    <input type="hidden" name="id" value="<?= (int)$project['id'] ?>">
  <?php endif; ?>

  <label>Title
    <input name="title" required minlength="3"
           value="<?= htmlspecialchars(old('title', $project['title'] ?? '')) ?>">
  </label>

  <label>Description
    <textarea name="description" rows="4" required minlength="20"><?= htmlspecialchars(old('description', $project['description'] ?? '')) ?></textarea>
  </label>

  <label>Status
    <?php $current = old('status', $project['status'] ?? 'Proposed'); ?>
    <select name="status">
      <?php foreach (['Proposed', 'In progress', 'Completed', 'Archived'] as $s): ?>
        <option <?= $current === $s ? 'selected' : '' ?>><?= $s ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Student
    <?php $cur = (int)old('student_id', (string)($project['student_id'] ?? 0)); ?>
    <select name="student_id">
      <?php foreach (all_students($pdo) as $s): ?>
        <option value="<?= (int)$s['id'] ?>" <?= $cur === (int)$s['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($s['full_name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Supervisor
    <?php $cur = (int)old('supervisor_id', (string)($project['supervisor_id'] ?? 0)); ?>
    <select name="supervisor_id">
      <?php foreach (all_supervisors($pdo) as $s): ?>
        <option value="<?= (int)$s['id'] ?>" <?= $cur === (int)$s['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($s['full_name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Category
    <?php $cur = (int)old('category_id', (string)($project['category_id'] ?? 0)); ?>
    <select name="category_id">
      <?php foreach (all_categories($pdo) as $c): ?>
        <option value="<?= (int)$c['id'] ?>" <?= $cur === (int)$c['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($c['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>

  <div class="form-actions">
    <a href="projects.php" class="button-ghost">Cancel</a>
    <button class="button">Save</button>
  </div>
</form>

<?php old_clear(); ?>
<?php require __DIR__ . '/../includes/footer.php'; ?>
