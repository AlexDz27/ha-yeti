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

$viewedLots = getViewedLots();
echo render('pages/history', ['viewedLots' => $viewedLots], 'История просмотров');


function getViewedLots() {
  $lotsIds = array_reverse(json_decode($_COOKIE['wasViewed']));

  $viewedLots = [];
  global $lots;
  foreach ($lotsIds as $lotId) {
    $viewedLots[$lotId] = $lots[$lotId];
  }

  return $viewedLots;
}