<?php

require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/data.php';
$config = getConfig();
if ($config['onService']) {
  echo render('pages/on-service');
  return;
}

echo render('pages/index', ['lots' => $lots], 'Главная');
