<?php
define("APP_ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR . "app". DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "AuthController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";


$database = new DatabaseController();
$data = new DataController();
$auth = new AuthController();

if ($data->isAjax()) {
    if (!empty($_POST['password']) && !empty($_POST['again']) && !empty($_POST['id'])) {
        $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
        $again = filter_var(trim($_POST['again']), FILTER_SANITIZE_STRING);
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);

        if ($password != $again) {
            die(json_encode([
            "status" => "validate",
            "message" => "The passwords you entered do not match."
          ]));
        }
        
        if (strlen($password) <= 8) {
            die(json_encode([
                    "status" => "validate",
                    "message" => "Your password is too short."
                ]));
        }

        switch ($data->checkPassword($password)) {
                case 'number':
                    die(json_encode([
                        "status" => "validate",
                        "message" => "Your password must contain 1 number."
                    ]));
                    break;
                case 'letter':
                    die(json_encode([
                        "status" => "validate",
                        "message" => "Your password must contain 1 letter."
                    ]));
                    break;
                case 'upper':
                    die(json_encode([
                        "status" => "validate",
                        "message" => "Your password must contain 1 uppercase letter."
                    ]));
                    break;
                case 'special':
                    die(json_encode([
                        "status" => "validate",
                        "message" => "Your password must contain 1 special character."
                    ]));
                    break;
            }

        $query = $database->openConnection()->prepare("SELECT * FROM `users` WHERE `recovery_token`=:id");
        $query->bindParam(":id", $id, PDO::PARAM_STR);

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

        if (!$fetch) {
            die(json_encode([
            "status" => "error",
            "message" => "Token not found"
        ]));
        }
        $passwordHash = $fetch->password;

        if (password_verify($password, $passwordHash)) {
            die(json_encode([
            "status" => "error",
            "message" => "The password you entered matches the current password."
        ]));
        }
        $uuid = $fetch->uuid;

        $options = [
            "cost" => 12,
        ];
        $newhash = password_hash($password, PASSWORD_BCRYPT, $options);
        $rt = $auth->generateStr(11);

        $update = $database->openConnection()->prepare("UPDATE `users` SET `password`=:password, `recovery_token`=:rt WHERE `uuid`=:uuid");
        $update->bindParam(":password", $newhash, PDO::PARAM_STR);
        $update->bindParam(":rt", $rt, PDO::PARAM_STR);
        $update->bindParam(":uuid", $uuid, PDO::PARAM_STR);

        $update->execute();

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
          "message" => "You suffessfully changed your password."
        ]));
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
