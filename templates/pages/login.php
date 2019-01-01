<form class="form container" action="<?= e($_SERVER['PHP_SELF']); ?>" method="post"> <!-- form--invalid -->
  <h2>Вход</h2>
  <div class="form__item"> <!-- form__item--invalid -->
    <label for="email">E-mail*</label>
    <?php $value = $loginData['email'] ?? ''; ?>
    <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $value ?>" required>
    <?php if (isset($errors['email']['value_missing'])): ?>
      <span class="form__error">Введите e-mail</span>
    <?php endif; ?>
    <?php if (isset($errors['email']['user_not_found'])): ?>
      <span class="form__error"><?= $errors['email']['user_not_found']; ?></span>
    <?php endif; ?>
  </div>
  <div class="form__item form__item--last">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="password" placeholder="Введите пароль" required>
    <?php if (!empty($errors['password'])): ?>
      <?php foreach ($errors['password'] as $error): ?>
        <span class="form__error"><?= $error; ?></span>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <button type="submit" class="button">Войти</button>
</form>