<?php
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("APP_ROOT", ROOT . "app" . DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "MailController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "AuthController.php";

$database = new DatabaseController();
$data = new DataController();
$mail = new MailController();
$auth = new AuthController();

if ($data->isAjax()) {
  if (!empty($_POST['email'] && !empty($_POST['password']))) {
    if (filter_var(trim($_POST['email'], FILTER_VALIDATE_EMAIL))) {
      $email = strtolower(filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL));
      $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

      session_start();

      $query = $database->openConnection()->prepare("SELECT * FROM `users` WHERE `id`=:id");
      $query->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);

      $query->execute();
      if (!$query) {
        $this->closeConnection();
        die(json_encode([
          "status" => "error",
          "message" => "Database error"
        ]));
      }
      $database->closeConnection();
      $fetch = $query->fetch(PDO::FETCH_OBJ);

      $oldemail = $fetch->email;
      if ($email == $oldemail) {
        die(json_encode([
          "status" => "error",
          "message" => "Your new email is same as old."
        ]));
      }

      $hash = $fetch->password;
      if (password_verify($password, $hash)) {

        $vt = $auth->generateStr(11);

        $update = $database->openConnection()->prepare("UPDATE `users` SET `email`=:email, `verified`='0', `verification_token`=:vt WHERE `id`=:id ");
        $update->bindParam(":email", $email, PDO::PARAM_STR);
        $update->bindParam(":vt", $vt, PDO::PARAM_STR);
        $update->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);

        $update->execute();

        $mail->sendVerifyMail($email, $fetch->name, $vt);

        if (!$update) {
          $database->closeConnection();
          return json_decode([
            "status" => "error",
            "message" => "Database error"
          ]);
        }
        $database->closeConnection();

        die(json_encode([
          "status" => "success",
          "message" => "You suffessfully changed your email."
        ]));
      } else {
        die(json_encode([
          "status" => "validate",
          "message" => "Password is wrong."
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
