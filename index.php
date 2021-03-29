<?php

date_default_timezone_set("Europe/Bratislava");

define("ROOT", __DIR__ . DIRECTORY_SEPARATOR);
define("APP_ROOT", __DIR__ . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR);


require_once APP_ROOT . "settings.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "RoutingController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "AuthController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "MailController.php";

$routing = new RoutingController();
$database = new DatabaseController();
$data = new DataController();
$auth = new AuthController();




require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "#default.php";
