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
  return render('layouts/layout', [
    'content' => $content,
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