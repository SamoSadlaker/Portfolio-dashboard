<?php
define("ROOT", __DIR__ . DIRECTORY_SEPARATOR);
define("APP_ROOT", __DIR__ . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR);


require_once APP_ROOT . "settings.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "RoutingController.php";

$routing = new RoutingController();

if (empty($_GET['url'])) {
    $_GET['url'] = "index";
}

$routing->routing($_GET['url']);
