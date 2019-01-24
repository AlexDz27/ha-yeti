<?php

session_start();
require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/db.php';
require_once 'inc/data.php';
$config = getConfig();
if ($config['onService']) {
  echo render('pages/on-service');
  return;
}


guardNotAuthorizedAccess();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $formData = $_POST;
  $avatarData = $_FILES['avatar'] ?? null;
  $formData['avatar'] = $avatarData;

  $required = ['email', 'password', 'name', 'message', 'avatar'];
  $notEmptyErrors = validateFieldsNotEmpty($formData, $required, 'Пожалуйста заполните поле');

  if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE) {
    $tmpName = $_FILES['avatar']['tmp_name'];
    $path = $_FILES['avatar']['name'];

    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($fileInfo, $tmpName);
    $mimeWhiteList = getConfig()['avatarImgAllowedMime'];
    foreach ($mimeWhiteList as $mime) {
      if (!in_array($fileType, $mimeWhiteList)) {
        $errors['avatar']['bad_mime'] = 'Загрузите картинку в формате jpeg или png';
      }
    }

    if ($_FILES['avatar']['size'] > 50000) {
      $errors['avatar']['big_file'] = 'Файл слишком большой';
    }

    if (empty($errors['avatar'])) {
      $uploadsFolderPath = getAvatarsUploadsFolder();
      move_uploaded_file($tmpName, $uploadsFolderPath . $path);
      $formData['avatar_path'] = $uploadsFolderPath . $path;
    }
  }
  
  $errors = array_merge($errors, $notEmptyErrors);
  var_dump($errors);
  if (!empty($errors)) {
    echo render('pages/register', compact('formData', 'errors'), 'Добавление лота');
  } else {
    $formData['passwordHash'] = password_hash($formData['password'], PASSWORD_DEFAULT);
    createUser($formData);
    loadLoggedUser($formData);
    setFlashMessage('logged_in', 'Вы успешно зашли!');
    redirectToMain();
  }
} else {
  echo render('pages/register', [], 'Добавление лота');
}

