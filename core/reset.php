<?php
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("APP_ROOT", ROOT . "app" . DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "MailController.php";

$database = new DatabaseController();
$data = new DataController();
$mail = new MailController();

if ($data->isAjax()) {
  if (!empty($_POST['email'])) {
    if (filter_var(trim($_POST['email'], FILTER_VALIDATE_EMAIL))) {
      $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

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
          "status" => "error",
          "message" => "User with this email doesn't exist."
        ]));
      }

      $mail->sendRecoveryMail($email, $fetch->recovery_token);

      die(json_encode([
        "status" => "success",
        "message" => "Recovery email has been sent."
      ]));
    } else {
      die(json_encode([
        "status" => "error",
        "message" => "Email is wrong"
      ]));
    }
  } else {
    die(json_encode([
      "status" => "error",
      "message" => "Inputs are empty."
    ]));
  }
} else {
  die(json_encode([
    "status" => "error",
    "message" => "Request is invalid."
  ]));
}
