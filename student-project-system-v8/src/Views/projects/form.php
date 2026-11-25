<?php use App\Support\View; $p = $project; ?>
<p class="eyebrow"><?= $p ? 'Edit' : 'Create' ?></p>
<h1><?= View::e($title) ?></h1>

<?php if (!empty($errors)): ?>
  <ul class="error-list">
    <?php foreach ($errors as $msg): ?><li><?= View::e($msg) ?></li><?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="post" action="<?= \App\Support\Url::to('/project-save.php') ?>">
  <?php if ($p): ?><input type="hidden" name="id" value="<?= (int)$p['id'] ?>"><?php endif; ?>

  <label>Title
    <input name="title" required minlength="3" value="<?= View::e($old('title', $p['title'] ?? '')) ?>">
  </label>
  <label>Description
    <textarea name="description" rows="4" required minlength="20"><?= View::e($old('description', $p['description'] ?? '')) ?></textarea>
  </label>
  <label>Status
    <?php $cur = $old('status', $p['status'] ?? 'Proposed'); ?>
    <select name="status">
      <?php foreach (['Proposed', 'In progress', 'Completed', 'Archived'] as $s): ?>
        <option <?= $cur === $s ? 'selected' : '' ?>><?= $s ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Student
    <?php $cur = (int)$old('student_id', (string)($p['student_id'] ?? 0)); ?>
    <select name="student_id">
      <?php foreach ($students as $s): ?>
        <option value="<?= (int)$s['id'] ?>" <?= $cur === (int)$s['id'] ? 'selected' : '' ?>><?= View::e($s['full_name']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Supervisor
    <?php $cur = (int)$old('supervisor_id', (string)($p['supervisor_id'] ?? 0)); ?>
    <select name="supervisor_id">
      <?php foreach ($supervisors as $s): ?>
        <option value="<?= (int)$s['id'] ?>" <?= $cur === (int)$s['id'] ? 'selected' : '' ?>><?= View::e($s['full_name']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Category
    <?php $cur = (int)$old('category_id', (string)($p['category_id'] ?? 0)); ?>
    <select name="category_id">
      <?php foreach ($categories as $c): ?>
        <option value="<?= (int)$c['id'] ?>" <?= $cur === (int)$c['id'] ? 'selected' : '' ?>><?= View::e($c['name']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <div class="form-actions">
    <a href="<?= \App\Support\Url::to('/projects.php') ?>" class="button-ghost">Cancel</a>
    <button class="button">Save</button>
  </div>
</form>
