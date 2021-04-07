<?php
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("APP_ROOT", ROOT . "app" . DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";

$database = new DatabaseController();
$data = new DataController();

if ($data->isAjax()) {
  if (!empty($_POST['title'] && !empty($_POST['type'])) && !empty($_POST['message'])) {

    if (filter_var(trim($_POST['title'], FILTER_VALIDATE_EMAIL))) {
      $title = (strtolower(ucfirst(filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING))));
      $type = (strtolower(ucfirst(filter_var(trim($_POST['type']), FILTER_SANITIZE_NUMBER_INT))));
      $message = (strtolower(ucfirst(filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING))));

      if (strlen($title) < 3) {
        die(json_encode([
          "status" => "validate",
          "message" => "Title is too short."
        ]));
      }

      if (strlen($message) < 6) {
        die(json_encode([
          "status" => "validate",
          "message" => "Your message is too short."
        ]));
      }

      session_start();

      $ticket = $database->openConnection()->prepare("INSERT INTO `ticket` (`name`, `type`, `from_user`) VALUES (:name, :type, :id)");
      $ticket->bindParam(":name", $title, PDO::PARAM_STR);
      $ticket->bindParam(":type", $type, PDO::PARAM_INT);
      $ticket->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);

      $ticket->execute();

      if (!$ticket) {
        $database->closeConnection();
        die(json_encode([
          "status" => "error",
          "message" => "Database error"
        ]));
      }
      $database->closeConnection();

      $ticket_id = $ticket->rowCount();

      $tmessage = $database->openConnection()->prepare("INSERT INTO `ticket.chat` (`ticket_id`, `from_user`, `message`) VALUES (:ticket_id, :id, :message)");
      $tmessage->bindParam(":ticket_id", $ticket_id, PDO::PARAM_INT);
      $tmessage->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);
      $tmessage->bindParam(":message", $message, PDO::PARAM_STR);

      $tmessage->execute();

      if (!$tmessage) {
        $database->closeConnection();
        die(json_encode([
          "status" => "error",
          "message" => "Database error"
        ]));
      }
      $database->closeConnection();
      die(json_encode([
        "status" => "success",
        "message" => "You successfuly created ticket."
      ]));
    } else {
      die(json_encode([
        "status" => "error",
        "message" => "Selected type is wrong."
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
