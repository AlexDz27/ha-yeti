<?php

require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/data.php';
$config = getConfig();
if ($config['onService']) {
  echo render('pages/on-service');
  return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $formData = $_POST;
  echo render('pages/form', compact('formData'));
} else {
  echo render('pages/form');
}

