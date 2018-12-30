<?php

require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/data.php';
$config = getConfig();
if ($config['onService']) {
  echo render('pages/on-service');
  return;
}

$categoryDict = [
  'boards-and-skis' => 'Доски и лыжи',
  'fixtures' => 'Крепления',
  'boots' => 'Ботинки',
  'clothes' => 'Одежда',
  'instruments' => 'Инструменты',
  'other' => 'Разное',
];
$lot = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $lot = $_POST;
  $lot['category'] = $categoryDict[$lot['category']];
  $lot['lot-img'] = $_FILES['lot-img']['name'];

  $errors = [];

  if ($lot['category'] === 'not-selected') {
    $lot['category'] = '';
  }

  $required = ['title', 'category', 'message', 'price', 'lot-step', 'lot-date', 'lot-img'];
  foreach ($required as $field) {
    if (empty($lot[$field])) {
      $errors[$field]['value_missing'] = 'Пожалуйста заполните поле';
    }
  }

  if (!empty($_FILES['lot-img'])) {
    $tmpName = $_FILES['lot-img']['tmp_name'];
    $path = $_FILES['lot-img']['name'];

    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($fileInfo, $tmpName);
    $mimeWhiteList = getConfig()['lotImgAllowedMime'];
    foreach ($mimeWhiteList as $mime) {
      if (!in_array($fileType, $mimeWhiteList)) {
        $errors['lot-img']['bad_mime'] = 'Загрузите картинку в формате jpeg или png';
      }
    }

    if ($_FILES['lot-img']['size'] > 50000) {
      $errors['lot-img']['big_file'] = 'Файл слишком большой';
    }

    if (empty($errors['lot-img'])) {
      $uploadsFolderPath = getUploadsFolder();
      move_uploaded_file($tmpName, $uploadsFolderPath . $path);
      $lot['img_url'] = $uploadsFolderPath . $path;
    }
  }

  $intFields = ['price', 'lot-step'];
  foreach ($intFields as $field) {
    $value = (int) $lot[$field];
    if ($value <= 0) {
      $errors[$field]['int_needed'] = 'Введите целочисленное число';
    }
  }

  $dateFields = ['lot-date'];
  foreach ($dateFields as $field) {
    if (!validateDate($lot[$field])) {
      $errors[$field]['bad_date'] = 'Неверный формат даты';
    }
  }

  if (!empty($errors)) {
    echo render('pages/add', compact('lot', 'errors'));
  } else {
    echo render('pages/lot', compact('lot'), $lot['title']);
  }
} else {
  echo render('pages/add', compact('lot'), 'Добавление лота');
}

