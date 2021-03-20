<?php

date_default_timezone_set("Europe/Bratislava");

define("ROOT", __DIR__ . DIRECTORY_SEPARATOR);
define("APP_ROOT", __DIR__ . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR);


require_once APP_ROOT . "settings.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "RoutingController.php";

$routing = new RoutingController();



require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "#default.php";
