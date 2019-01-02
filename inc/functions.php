<?php

require_once 'config.php';
require_once 'data.php';

function render($viewPath, $viewData = [], $pageTitle = null) {
  $tplConfig = getTemplatesConfig();
  $path = $tplConfig['tplFolder'] . $viewPath . '.php';

  if (!file_exists($path)) {
    throwException('View file with path ' . $path . ' doesn\'t exist');
  }
  if (!is_array($viewData)) {
    throwException('View data has to be of type array, ' . gettype($viewData) . ' given');
  }

  extract($viewData);

  ob_start();

  include $path;
  $content = ob_get_clean();
  
  if (hasStringSubstring($viewPath, $tplConfig['pages'])) {
    return renderPage($content, $pageTitle);
  }

  return $content;
}
function renderPage($content, $pagetitle) {
  return renderLayout($content, $pagetitle);
}
function renderLayout($content, $pagetitle) {
  $title = getConfig()['pageTitle'];
  $title .= $pagetitle ? ' | ' . $pagetitle : '';
  $user = $_SESSION['user'] ?? null;
  return render('layouts/layout', [
    'content' => $content,
    'user' => $user,
    'pageTitle' => $title,
    'categories' => getMockData()['categories']
  ]);
}

function esc($string, $doStrip = false) {
  if ($doStrip === true) {
    return strip_tags($string);
  }

  return htmlspecialchars($string);
}
function e($string, $doStrip = false) {
  return esc($string, $doStrip);
}

function throwException($msg, $httpCode = 500) {
  http_response_code($httpCode);
  throw new Exception($msg);
}

function getTimeUntilTomorrowMidnight($format = 'H:i:s') {
  $tomorrowMidnightTS = strtotime('midnight tomorrow');
  $nowTS = strtotime('now');
  $untilTomorrowMidnight = $tomorrowMidnightTS - $nowTS;

  return gmdate($format, $untilTomorrowMidnight);
}

function getMockData() {
  require_once 'data.php';
  global $allData;

  return $allData;
}

function hasStringSubstring($string, $substring) {
  return strpos($string, $substring) !== false;
}

function validateDate($date, $format = 'Y-m-d') {
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) == $date;
}

function validateFieldsNotEmpty($entity, $fields, $msg) {
  $errors = [];
  foreach ($fields as $field) {
    if (empty($entity[$field])) {
      $errors[$field]['value_missing'] = $msg;
    }
  }

  return $errors;
}

function validateIntFields($entity, $fields, $msg) {
  $errors = [];
  foreach ($fields as $field) {
    $value = (int) $entity[$field];
    if ($value <= 0) {
      $errors[$field]['int_required'] = $msg;
    }
  }

  return $errors;
}

function validateDateFields($entity, $fields, $msg) {
  $errors = [];
  foreach ($fields as $field) {
    if (!validateDate($entity[$field])) {
      $errors[$field]['bad_date'] = $msg;
    }
  }

  return $errors;
}

/**
 * @return array|null
 */
function getCurrentUser() {
  return $_SESSION['user'] ?? null;
}

function isLogged() {
  return getCurrentUser() !== null;
}

function guardAuthorizedAccess() {
  if (getCurrentUser() === null) {
    redirectBackAsNotAuthorized();
  }
}

function redirectToMain() {
  header('Location: /');
  die();
}

function redirectBackAsNotAuthorized() {
  http_response_code(403);
  redirectBack();
}

function redirectBack() {
  $referrer = $_SERVER['HTTP_REFERER'] ?? null;
  $location = $referrer ?? '/';
  header('Location: ' . $location);
  die();
}

function convertUnixToMysqlTimestamp($unix) {
  return date('Y-m-d H:i:s', $unix);
}

function sendServerErrorMessageOnProd() {
  if (getConfig()['prodEnv']) {
    echo '<h1 style="color: #ff4b52">An error occurred in our servers. Please come back in a few minutes</h1>';
    die();
  }
}