<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('WEB_ROOT', $_SERVER['HTTP_HOST'] . '/');

$GLOBALS['config'] = [
  'appName' => 'yeti-cave',
  'pageTitle' => 'Йети-кейв',
  'templates' => [
    'tplFolder' => 'templates/',
    'layouts' => 'layouts/',
    'pages' => 'pages/',
    'blocks' => 'blocks/'
  ],
  'onService' => false,
  'lotImgAllowedMime' => ['image/jpeg', 'image/png'],
  'uploadsFolder' => 'uploads/lots/'
];

function getUploadsFolder() {
  return getConfig()['uploadsFolder'];
}

function getTemplatesConfig() {
  return getConfig()['templates'];
}

function getConfig() {
  return $GLOBALS['config'];
}