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

$lot_id = $_GET['lot_id'] ?? null;
$lot = $lots[$lot_id] ?? null;

if ($lot === null) {
  http_response_code(404);
}

if ($lot !== null) {
  $initialValue = json_encode([$lot_id]);
  $viewHistoryCookie = [
    'name' => 'wasViewed',
    'value' => $initialValue,
    'expire' => strtotime('+30 days'),
    'path' => '/'
  ];

  if (isset($_COOKIE[$viewHistoryCookie['name']])) {
    $visitedLotIds = json_decode($_COOKIE[$viewHistoryCookie['name']]);
    if (!in_array($lot_id, $visitedLotIds)) {
      array_push($visitedLotIds, $lot_id);
    }

    $_COOKIE[$viewHistoryCookie['name']] = json_encode($visitedLotIds);
  }

  setcookie(
    $viewHistoryCookie['name'],
    $_COOKIE[$viewHistoryCookie['name']] ?? $viewHistoryCookie['value'],
    $viewHistoryCookie['expire'],
    $viewHistoryCookie['path']
  );
}

echo render('pages/lot', ['lot' => $lot], $lot['title']);
