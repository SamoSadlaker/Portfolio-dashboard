<?php
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("APP_ROOT", ROOT . "app" . DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "AuthController.php";

$database = new DatabaseController();
$data = new DataController();
$auth = new AuthController();

if ($data->isAjax()) {
  if (!empty($_POST['old'] && !empty($_POST['password']) && !empty($_POST['again']))) {
    $old = filter_var(trim($_POST['old']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $again = filter_var(trim($_POST['again']), FILTER_SANITIZE_STRING);

    if ($password != $again) {
      die(json_encode(["status" => "validate", "message" => "The passwords you entered do not match."]));
    }

    if ($old == $password) {
      die(json_encode(["status" => "validate", "message" => "The passwords you entered is same as your old password."]));
    }

    if (strlen($password) <= 8) {
      die(json_encode(["status" => "validate", "message" => "Your password is too short."]));
    }
    switch ($data->checkPassword($password)) {
      case 'number':
        die(json_encode(["status" => "validate", "message" => "Your password must contain 1 number."]));
        break;
      case 'letter':
        die(json_encode(["status" => "validate", "message" => "Your password must contain 1 letter."]));
        break;
      case 'upper':
        die(json_encode(["status" => "validate", "message" => "Your password must contain 1 uppercase letter."]));
        break;
      case 'special':
        die(json_encode(["status" => "validate", "message" => "Your password must contain 1 special character."]));
        break;
    }
    session_start();
    $query = $database->openConnection()->prepare("SELECT * FROM `users` WHERE `id`=:id");
    $query->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);

    $query->execute();
    if (!$query) {
      $this->closeConnection();
      die(json_encode(["status" => "error", "message" => "Database error"]));
    }
    $database->closeConnection();
    $fetch = $query->fetch(PDO::FETCH_OBJ);

    $passwordHash = $fetch->password;

    if (password_verify($old, $passwordHash)) {
      $options = [
        "cost" => 12,
      ];
      $newhash = password_hash($password, PASSWORD_BCRYPT, $options);

      $update = $database->openConnection()->prepare("UPDATE `users` SET `password`=:password WHERE `id`=:id");
      $update->bindParam(":password", $newhash, PDO::PARAM_STR);
      $update->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);

      $update->execute();

      if (!$update) {
        $database->closeConnection();
        return json_decode([
          "status" => "error",
          "message" => "Database error"
        ]);
      }
      $database->closeConnection();
      die(json_encode(["status" => "success", "message" => "YAY"]));
    } else {
      die(json_encode(["status" => "validate", "message" => "Wrong password."]));
    }
  } else {
    die(json_encode(["status" => "validate", "message" => "Inputs are empty."]));
  }
} else {
  die(json_encode(["status" => "error", "message" => "Request is invalid."]));
}
