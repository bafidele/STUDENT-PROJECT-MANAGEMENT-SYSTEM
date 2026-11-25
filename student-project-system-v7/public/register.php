<?php
declare(strict_types=1);
session_start();

$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old']    ?? [];
$flash  = $_SESSION['flash']  ?? null;
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['flash']);

$title = 'Register';
require __DIR__ . '/../includes/header.php';
?>
<p class="eyebrow">Create account</p>
<h1>Register a project</h1>

<?php if ($flash): ?>
  <p class="success"><?= htmlspecialchars($flash) ?></p>
<?php endif; ?>

<?php if ($errors): ?>
  <ul class="error-list">
    <?php foreach ($errors as $msg): ?>
      <li><?= htmlspecialchars($msg) ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="post" action="process-registration.php" novalidate>
  <label>Full name
    <input name="name" required minlength="3" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
  </label>
  <label>Email
    <input name="email" type="email" required value="<?= htmlspecialchars($old['email'] ?? '') ?>">
  </label>
  <button class="button">Register</button>
</form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
