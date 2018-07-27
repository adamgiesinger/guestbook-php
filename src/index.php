<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Guestbook\Core\Controller;
use Symfony\Component\HttpFoundation\Request;

$autoloader = require_once "autoload.php";

$controller = new Controller($autoloader);

$request = Request::createFromGlobals();
$response = $controller->handle($request);
$response->send();
