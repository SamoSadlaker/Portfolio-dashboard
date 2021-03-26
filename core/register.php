<?php
define("APP_ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR . "app". DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "AuthController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";

$auth = new AuthController();
$data = new DataController();

if ($data->isAjax()) {
    if (!empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        return "";
    }
} else {
    die(json_encode([
    "status" => "error",
    "message" => "Request is invalid."
  ]));
}
