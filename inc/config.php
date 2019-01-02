<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('WEB_ROOT', $_SERVER['HTTP_HOST'] . '/');

$GLOBALS['config'] = [
  'appName' => 'yeti-cave',
  'prodEnv' => false,
  'pageTitle' => 'Йети-кейв',
  'templates' => [
    'tplFolder' => 'templates/',
    'layouts' => 'layouts/',
    'pages' => 'pages/',
    'blocks' => 'blocks/'
  ],
  'onService' => false,
  'lotImgAllowedMime' => ['image/jpeg', 'image/png'],
  'uploadsFolder' => 'uploads/lots/',
  'db' => [
    'host' => 'localhost',
    'name' => 'ha_yeti_cave',
    'user' => 'root',
    'password' => '',
    'char_set' => 'utf8'
  ]
];

function getUploadsFolder() {
  return getConfig()['uploadsFolder'];
}

function getDbConfig() {
  return getConfig()['db'];
}

function getTemplatesConfig() {
  return getConfig()['templates'];
}

function getConfig() {
  return $GLOBALS['config'];
}