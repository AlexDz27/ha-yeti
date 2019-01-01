<?php
$errors = $errors ?? [];
?>

<form class="form form--add-lot container <?= $errors ? 'form--invalid' : ''?>" action="<?= e($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Добавление лота</h2>
  <div class="form__container-two">
    <div class="form__item <?= !empty($errors['title']) ? 'form__item--invalid' : '' ?>"> <!-- form__item--invalid -->
      <label for="lot-name">Наименование</label>
      <input id="lot-name" value="<?= $lot['title'] ?>" type="text" name="title" placeholder="Введите наименование лота" required>
      <?php if (!empty($errors['title'])): ?>
        <span class="form__error">Введите наименование лота</span>
      <?php endif; ?>
    </div>
    <div class="form__item">
      <label for="category">Категория</label>
      <select id="category" name="category" required>
        <?php
        $selectOptions = [
          'not-selected' => 'Выберите категорию',
          'boards-and-skis' => 'Доски и лыжи',
          'fixtures' => 'Крепления',
          'boots' => 'Ботинки',
          'clothes' => 'Одежда',
          'instruments' => 'Инструменты',
          'other' => 'Разное'
        ];
        ?>
        <?php foreach ($selectOptions as $value => $optName): ?>
          <option value="<?= $value; ?>" <?= $lot['category'] === $value ? 'selected' : '' ?>><?= $optName; ?></option>
        <?php endforeach; ?>
      </select>
      <?php if (!empty($errors['category'])): ?>
        <span class="form__error">Выберите категорию</span>
      <?php endif; ?>
    </div>
  </div>
  <div class="form__item form__item--wide">
    <label for="message">Описание</label>
    <textarea id="message" name="message" placeholder="Напишите описание лота" class="<?= $errors ? 'form__item--invalid' : ''?>" required><?= $lot['message']; ?></textarea>
    <?php if (!empty($errors['message'])): ?>
      <span class="form__error">Напишите описание лота</span>
    <?php endif; ?>
  </div>
  <div class="form__item form__item--file <?= !empty($lot['lot-img']) ? 'form__item--uploaded' : '' ?>"> <!-- form__item--uploaded -->
    <label>Изображение</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
      </div>
    </div>
    <div class="form__input-file">
      <input class="<?= !empty($errors['lot-img']) ? 'form__item--invalid' : '' ?>" type="file" id="photo2" name="lot-img">
      <label for="photo2">
        <span class="<?= !empty($errors['lot-img']) ? 'form__item--invalid' : '' ?>">+ Добавить</span>
      </label>
      <?php if (!empty($errors['lot-img'])): ?>
        <span class="form__error">Загрузите картинку</span>
      <?php endif; ?>
      <?= !empty($errors['lot-img']['big_file']) ? '<span class="form__error">Картинка слишком большая!</span>' : '' ?>
    </div>
  </div>
  <div class="form__container-three">
    <div class="form__item form__item--small">
      <label for="lot-rate">Начальная цена</label>
      <input class="<?= !empty($errors['price']) ? 'form__item--invalid' : '' ?>" value="<?= $lot['price']; ?>" id="lot-rate" type="number" name="price" placeholder="0" required>
      <?php if (!empty($errors['price'])): ?>
        <span class="form__error">Введите начальную цену</span>
      <?php endif; ?>
    </div>
    <div class="form__item form__item--small">
      <label for="lot-step">Шаг ставки</label>
      <input value="<?= $lot['lot-step']; ?>" id="lot-step" type="number" name="lot-step" placeholder="0" required>
      <?php if (!empty($errors['lot-step'])): ?>
        <span class="form__error">Введите шаг ставки</span>
      <?php endif; ?>
    </div>
    <div class="form__item">
      <label for="lot-date">Дата окончания торгов</label>
      <input value="<?= $lot['lot-date']; ?>" class="form__input-date" id="lot-date" type="date" name="lot-date" required>
      <?php if (!empty($errors['lot-date'])): ?>
        <span class="form__error">Введите дату завершения торгов</span>
      <?php endif; ?>
    </div>
  </div>
  <?php if (!empty($errors)): ?>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <?php endif; ?>
  <button type="submit" class="button">Добавить лот</button>
</form>