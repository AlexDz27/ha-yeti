<li class="lots__item lot">
  <div class="lot__image">
      <img src="<?= $lot['img_path']; ?>" width="350" height="260" alt="<?= e($lot['title']) ?>">
  </div>
  <div class="lot__info">
      <span class="lot__category"><?= e($lot['category']); ?></span>
      <h3 class="lot__title"><a class="text-link" href="lot.php?lot_id=<?= $lot['id']; ?>"><?= e($lot['title']); ?></a></h3>
      <div class="lot__state">
          <div class="lot__rate">
              <span class="lot__amount">Стартовая цена</span>
              <span class="lot__cost"><?= e($lot['price']); ?><b class="rub">р</b></span>
          </div>
          <div class="lot__timer timer">
              <?= $lot['bet_time'] ?? getTimeUntilTomorrowMidnight(); ?>
          </div>
      </div>
  </div>
</li>