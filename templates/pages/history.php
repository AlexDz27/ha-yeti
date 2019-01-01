<main>
  <div class="container">
    <section class="lots">
      <h2>История просмотров</h2>
      <?php if (!empty($viewedLots)): ?>
        <ul class="lots__list">
          <?php foreach ($viewedLots as $key => $lot): ?>
            <?= render('blocks/lot', ['lot' => $lot, 'id' => $key]) ?>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <h2>У вас нет истории просмотра лотов!</h2>
      <?php endif; ?>
    </section>
    <ul class="pagination-list">
      <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
      <li class="pagination-item pagination-item-active"><a>1</a></li>
      <li class="pagination-item"><a href="#">2</a></li>
      <li class="pagination-item"><a href="#">3</a></li>
      <li class="pagination-item"><a href="#">4</a></li>
      <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul>
  </div>
</main>