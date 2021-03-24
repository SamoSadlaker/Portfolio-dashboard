<?php
define("APP_ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR . "app". DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "AuthController.php";

$auth = new AuthController();

// $auth->Register("Samuel", "Šadlák", "samosadlaker", "dev@samosadlaker.eu", "samo");
