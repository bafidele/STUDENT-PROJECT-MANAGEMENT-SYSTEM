<p class="eyebrow">Overview</p>
<h1>Dashboard</h1>
<section class="card-grid">
  <article class="card"><span class="eyebrow">Total</span><p class="stat"><?= (int)$stats['total'] ?></p></article>
  <article class="card"><span class="eyebrow">Proposed</span><p class="stat"><?= (int)$stats['proposed'] ?></p></article>
  <article class="card"><span class="eyebrow">In progress</span><p class="stat"><?= (int)$stats['in_progress'] ?></p></article>
  <article class="card"><span class="eyebrow">Completed</span><p class="stat"><?= (int)$stats['completed'] ?></p></article>
</section>
