<?php

session_start();
require_once 'inc/config.php';
require_once 'inc/functions.php';


$_SESSION['user'] = null;

redirectToMain();