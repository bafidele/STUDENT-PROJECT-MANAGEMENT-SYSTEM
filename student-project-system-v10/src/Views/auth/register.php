<?php use App\Support\View; ?>
<p class="eyebrow">Create account</p>
<h1>Register a project</h1>

<?php if (!empty($success)): ?>
  <p class="success"><?= View::e($success) ?></p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
  <ul class="error-list">
    <?php foreach ($errors as $msg): ?><li><?= View::e($msg) ?></li><?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="post" action="<?= \App\Support\Url::to('/process-registration.php') ?>" novalidate>
  <input type="hidden" name="_csrf" value="<?= \App\Support\Csrf::token() ?>">
  <label>Full name
    <input name="name" required minlength="3" value="<?= View::e($old('name')) ?>">
  </label>
  <label>Email
    <input name="email" type="email" required value="<?= View::e($old('email')) ?>">
  </label>
  <button class="button">Register</button>
</form>
