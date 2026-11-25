<?php
declare(strict_types=1);
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/queries.php';

$id = (int)($_GET['id'] ?? 0);
$p  = find_project(spms_pdo(), $id);
if (!$p) { http_response_code(404); exit('Not found'); }

$title = $p['title'];
require __DIR__ . '/../includes/header.php';
?>
<p class="eyebrow"><?= htmlspecialchars($p['status']) ?></p>
<h1><?= htmlspecialchars($p['title']) ?></h1>
<p><?= nl2br(htmlspecialchars($p['description'])) ?></p>
<p><a href="projects.php" class="button-ghost">Back</a></p>
<?php require __DIR__ . '/../includes/footer.php'; ?>
