<?php $class = isset($errors) ? 'form--invalid' : ''; ?>
<form class="form container <?= $class ?>" action="<?= e($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Регистрация нового аккаунта</h2>
  <?php $class = null; ?>
  <div class="form__item"> <!-- form__item--invalid -->
    <label for="email">E-mail*</label>
    <?php $value = $formData['email'] ?? ''; ?>
    <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $value ?>" required>
    <?php if (!empty($errors['email'])): ?>
      <?php foreach ($errors['email'] as $error): ?>
        <span class="form__error"><?= $error; ?></span>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="form__item">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="password" placeholder="Введите пароль" required>
    <?php if (!empty($errors['avatar'])): ?>
      <?php foreach ($errors['avatar'] as $error): ?>
        <span class="form__error"><?= $error; ?></span>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="form__item">
    <?php $value = $formData['name'] ?? ''; ?>
    <label for="name">Имя*</label>
    <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= $value ?>" required>
    <?php if (!empty($errors['name'])): ?>
      <?php foreach ($errors['name'] as $error): ?>
        <span class="form__error"><?= $error; ?></span>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="form__item">
    <?php $value = $formData['message'] ?? ''; ?>
    <label for="message">Контактные данные*</label>
    <textarea id="message" name="message" placeholder="Напишите как с вами связаться" required><?= $value ?></textarea>
    <?php if (!empty($errors['message'])): ?>
      <?php foreach ($errors['message'] as $error): ?>
        <span class="form__error"><?= $error; ?></span>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="form__item form__item--file form__item--last">
    <label>Аватар</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
      </div>
    </div>
    <div class="form__input-file">
      <input type="file" name="avatar" id="photo2" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
    <?php if (!empty($errors['avatar'])): ?>
      <?php foreach ($errors['avatar'] as $error): ?>
        <span class="form__error"><?= $error; ?></span>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <?php if (!empty($errors)): ?>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <?php endif; ?>
  <button type="submit" class="button">Зарегистрироваться</button>
  <a class="text-link" href="#">Уже есть аккаунт</a>
</form>