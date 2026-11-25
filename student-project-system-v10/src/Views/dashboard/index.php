<p class="eyebrow">Overview</p>
<h1>Dashboard</h1>
<section class="card-grid">
  <article class="card"><span class="eyebrow">Total</span><p class="stat" data-stat="total"><?= (int)$stats['total'] ?></p></article>
  <article class="card"><span class="eyebrow">Proposed</span><p class="stat" data-stat="proposed"><?= (int)$stats['proposed'] ?></p></article>
  <article class="card"><span class="eyebrow">In progress</span><p class="stat" data-stat="in_progress"><?= (int)$stats['in_progress'] ?></p></article>
  <article class="card"><span class="eyebrow">Completed</span><p class="stat" data-stat="completed"><?= (int)$stats['completed'] ?></p></article>
</section>

<script src="<?= \App\Support\Url::to('/assets/js/api.js') ?>"></script>
<script src="<?= \App\Support\Url::to('/assets/js/dashboard.js') ?>"></script>
