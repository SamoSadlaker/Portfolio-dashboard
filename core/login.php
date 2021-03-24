<?php
define("APP_ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR . "app". DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "AuthController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";

$auth = new AuthController();
$data = new DataController();

if ($data->isAjax()) {
    if (!empty($_POST['email'] && !empty($_POST['password']))) {
        if (filter_var(trim($_POST['email'], FILTER_VALIDATE_EMAIL))) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

            die($auth->Login($email, $password));
        } else {
            die(json_encode([
        "status" => "validate",
        "message" => "Email is wrong"
      ]));
        }
    } else {
        die(json_encode([
    "status" => "validate",
    "message" => "Inputs are empty."
  ]));
    }
} else {
    die(json_encode([
    "status" => "error",
    "message" => "Request is invalid."
  ]));
}
