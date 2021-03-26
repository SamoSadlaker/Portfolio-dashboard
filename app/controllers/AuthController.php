<?php
class AuthController extends DatabaseController
{
    public function generateStr($length)
    {
        return substr(sha1(rand()), 0, $length);
    }

    public function setStatus($status)
    {
        $query = $this->openConnection()->prepare("UPDATE `users` SET `status`=:status WHERE `id`=:id");
        $query->bindParam(":status", $status, PDO::PARAM_INT);
        $query->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);

        $query->execute();

        $this->closeConnection();
    }

    public function Register($name, $lastname, $username, $email, $password)
    {
        $options = [
            "cost" => 12,
        ];
        
        $password = password_hash($password, PASSWORD_BCRYPT, $options);
        $uuid = $this->generateStr(9);
        $vt = $this->generateStr(11);
        $rt = $this->generateStr(11);

        $query = $this->openConnection()->prepare("INSERT INTO `users` (`uuid`, `name`, `lastname`, `username`, `email`, `password`, `verification_token`, `recovery_token`) VALUES (:uuid, :name, :lastname, :username, :email, :password, :verification_token, :recovery_token)");
        $query->bindParam(":uuid", $uuid, PDO::PARAM_STR);
        $query->bindParam(":name", $name, PDO::PARAM_STR);
        $query->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $query->bindParam(":username", $username, PDO::PARAM_STR);
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->bindParam(":password", $password, PDO::PARAM_STR);
        $query->bindParam(":verification_token", $vt, PDO::PARAM_STR);
        $query->bindParam(":recovery_token", $rt, PDO::PARAM_STR);

        $query->execute();

        if (!$query) {
            $this->closeConnection();
            return json_decode([
                "status" => "error",
                "message" => "Database error"
            ]);
        }

        $this->closeConnection();
    }




    public function IsLoged()
    {
        session_start();
        if (!$_SESSION["isLoged"]) {
            $routing = new RoutingController();
            $routing->redirect("/login");
            die();
        }
    }

    public function aLoged()
    {
        session_start();
        if (isset($_SESSION['isLoged']) && $_SESSION["isLoged"]) {
            $routing = new RoutingController();
            $routing->redirect("/");
            die();
        }
    }


    public function Logout()
    {
        session_start();
        $this->setStatus(0);
        session_unset();
        session_destroy();
        
        $routing = new RoutingController();
        $routing->redirect("/login");
    }
}
