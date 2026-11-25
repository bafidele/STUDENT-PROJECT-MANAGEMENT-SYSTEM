<?php use App\Support\View; ?>
<p class="eyebrow"><?= View::e($project['status']) ?></p>
<h1><?= View::e($project['title']) ?></h1>
<p><?= nl2br(View::e($project['description'])) ?></p>
<p><a href="<?= \App\Support\Url::to('/projects.php') ?>" class="button-ghost">Back</a></p>
