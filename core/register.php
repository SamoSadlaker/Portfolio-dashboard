<?php
define("APP_ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR . "app". DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "AuthController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";


$database = new DatabaseController();
$data = new DataController();
$auth = new AuthController();

if ($data->isAjax()) {
    if (!empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);
        $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);

        if (strlen($name) <= 2) {
            die(json_encode([
                "status" => "validate",
                "message" => "Your name is too short."
            ]));
        }

        if (strlen($lastname) <= 3) {
            die(json_encode([
                "status" => "validate",
                "message" => "Your lastname is too short."
            ]));
        }

        if (strlen($username) <= 4) {
            die(json_encode([
                "status" => "validate",
                "message" => "Your username is too short."
            ]));
        }

        if (filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
            $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

            $query = $database->openConnection()->prepare("SELECT `id` FROM `users` WHERE `email`=:email");
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
            $fetch = $query->fetchColumn();


            if ($fetch != 1) {
                $options = [
                        "cost" => 12,
                    ];
                $hash = password_hash($password, PASSWORD_BCRYPT, $options);
                $uuid = $auth->generateStr(9);
                $vt = $auth->generateStr(11);
                $rt = $auth->generateStr(11);

                $query = $database->openConnection()->prepare("INSERT INTO `users` (`uuid`, `name`, `lastname`, `username`, `email`, `password`, `verification_token`, `recovery_token`) VALUES (:uuid, :name, :lastname, :username, :email, :password, :verification_token, :recovery_token)");
                $query->bindParam(":uuid", $uuid, PDO::PARAM_STR);
                $query->bindParam(":name", ucfirst($name), PDO::PARAM_STR);
                $query->bindParam(":lastname", ucfirst($lastname), PDO::PARAM_STR);
                $query->bindParam(":username", strtolower($username), PDO::PARAM_STR);
                $query->bindParam(":email", strtolower($email), PDO::PARAM_STR);
                $query->bindParam(":password", $hash, PDO::PARAM_STR);
                $query->bindParam(":verification_token", $vt, PDO::PARAM_STR);
                $query->bindParam(":recovery_token", $rt, PDO::PARAM_STR);

                $query->execute();

                if (!$query) {
                    $database->closeConnection();
                    return json_decode([
                "status" => "error",
                "message" => "Database error"
            ]);
                }
                $database->closeConnection();

                session_start();
                $_SESSION["id"] = $query->rowCount();
                $_SESSION["uuid"] = $uuid;
                $_SESSION["name"] = $name;
                $_SESSION["lastname"] = $lastname;
                $_SESSION["rank"] = "0";
                $_SESSION["isLoged"] = true;
                $_SESSION["email"] = $email;
                $auth->setStatus(1);

                die(json_encode([
                        "status" => "success",
                        "message" => "You suffessfully registred."
                      ]));
            } else {
                die(json_encode([
                    "status" => "error",
                    "message" => "User with this credentials is already exist."
                  ]));
            }
        } else {
            die(json_encode([
                "status" => "error",
                "message" => "Your email is wrong."
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
