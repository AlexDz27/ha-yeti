<?php

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

echo render('pages/lot', ['lot' => $lot], $lot['title']);