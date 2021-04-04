<?php
define("APP_ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR . "app". DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "AuthController.php";

$database = new DatabaseController();
$data = new DataController();
$auth = new AuthController();

if ($data->isAjax()) {
    if (!empty($_POST['email'] && !empty($_POST['password']))) {
        if (filter_var(trim($_POST['email'], FILTER_VALIDATE_EMAIL))) {
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);

            $query = $database->openConnection()->prepare("SELECT * FROM `users` WHERE `email`=:email");
            $query->bindParam(":email", $email, PDO::PARAM_STR);

            $query->execute();

            if (!$query) {
                $database->closeConnection();
                die(json_encode([
                "status" => "error",
                "message" => "Database error"
            ]));
            }

            $database->closeConnection();
            $fetch = $query->fetch(PDO::FETCH_OBJ);

            if (!$fetch) {
                die(json_encode([
                "status" => "validate",
                "message" => "User with this email doesn't exist."
              ]));
            }

            $passwordHash = $fetch->password;

            if (password_verify($password, $passwordHash)) {
                session_start();
                $_SESSION["id"] = $fetch->id;
                $_SESSION["uuid"] = $fetch->uuid;
                $_SESSION["name"] = $fetch->name;
                $_SESSION["lastname"] = $fetch->lastname;
                $_SESSION["username"] = $fetch->username;
                $_SESSION["profile"] = $fetch->image;
                $_SESSION["rank"] = $fetch->type;
                $_SESSION["verified"] = $fetch->verified;
                $_SESSION["isLoged"] = true;
                $_SESSION["email"] = $fetch->email;
                $auth->setStatus(1);
                die(json_encode([
                "status" => "success",
                "message" => "Successfully loged in"
            ]));
            } else {
                die(json_encode([
                "status" => "error",
                "message" => "The credentials are incorrect"
              ]));
            }
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
