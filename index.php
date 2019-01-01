<?php

session_start();
require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/data.php';
$config = getConfig();
if ($config['onService']) {
  echo render('pages/on-service');
  return;
}

$user = $_SESSION['user'] ?? null;
$loggedInMsg = $_SESSION['messages']['logged_in'] ?? null;
echo render('pages/index', ['lots' => $lots, 'loggedInMsg' => $loggedInMsg], 'Главная');

if (isset($_SESSION['messages']['logged_in'])) {
  unset($_SESSION['messages']['logged_in']);
}
