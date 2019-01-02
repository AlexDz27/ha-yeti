<?php

session_start();
require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/db.php';
require_once 'inc/data.php';
$dbConfig = getConfig();
if ($dbConfig['onService']) {
  echo render('pages/on-service');
  return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $loginData = $_POST;
  $errors = [];

  $required = ['email', 'password'];
  $notEmptyErrors = validateFieldsNotEmpty($loginData, $required, 'Пожалуйста заполните поле');

  $user = getUserByEmail($loginData['email']);
  if ($user === null) {
    $errors['email']['user_not_found'] = 'Не найдено пользователя с таким e-mail';
  }

  if ($user) {
    if (password_verify($loginData['password'], $user['password_hash'])) {
      $_SESSION['user'] = $user;
      $_SESSION['messages']['logged_in'] = 'Вы успешно зашли!';
      header('Location: /');
      die();
    } else {
      $errors['password']['wrong_password'] = 'Неверный пароль';
    }
  }

  $errors = array_merge($errors, $notEmptyErrors);
  echo render('pages/login', compact('loginData', 'errors'), 'Войти');
} else {
  echo render('pages/login', ['errors' => null], 'Войти');
}

