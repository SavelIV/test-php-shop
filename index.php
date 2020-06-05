<?php

// FRONT CONTROLLER

// General settings
ini_set('display_errors',0);
error_reporting(0);

session_start();

// system files loading
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');

$router = new Router();
$router->run();