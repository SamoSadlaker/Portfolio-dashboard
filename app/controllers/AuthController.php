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

    public function recoverPassword()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = filter_var(trim($_GET['id']), FILTER_SANITIZE_STRING);

            $query = $this->openConnection()->prepare("SELECT * FROM `users` WHERE `recovery_token`=:id");
            $query->bindParam(":id", $id, PDO::PARAM_STR);

            $query->execute();
            if (!$query) {
                $this->closeConnection();
                die(json_encode([
                    "status" => "error",
                    "message" => "Database error"
                ]));
            }
            $this->closeConnection();
            $fetch = $query->fetch(PDO::FETCH_OBJ);

            if (!$fetch) {
                header("Location: /login");
            }
            return $fetch->recovery_token;
        } else {
            header("Location: /login");
        }
    }

    public function verifyAccount()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = filter_var(trim($_GET['id']), FILTER_SANITIZE_STRING);

            $query = $this->openConnection()->prepare("SELECT * FROM `users` WHERE `verification_token`=:id");
            $query->bindParam(":id", $id, PDO::PARAM_STR);

            $query->execute();
            if (!$query) {
                $this->closeConnection();
                die(json_encode([
                    "status" => "error",
                    "message" => "Database error"
                ]));
            }
            $this->closeConnection();
            $fetch = $query->fetch(PDO::FETCH_OBJ);

            if (!$fetch) {
                header("Location: /");
            }

            $uuid = $fetch->uuid;
            $vt = $this->generateStr(11);

            $update = $this->openConnection()->prepare("UPDATE `users` SET `verification_token`=:vt, `verified`='1' WHERE `uuid`=:uuid");
            $update->bindParam(":vt", $vt, PDO::PARAM_STR);
            $update->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            $update->execute();
            if (!$update) {
                $this->closeConnection();
                die(json_encode([
                    "status" => "error",
                    "message" => "Database error"
                ]));
            }
            $this->closeConnection();
            header("Location: /");
        } else {
            header("Location: /");
        }
    }
    public function getProfile($id)
    {
        $query = $this->openConnection()->prepare("SELECT `image` FROM `users` WHERE `id`=:id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        if (!$query) {
            $this->closeConnection();
            die(json_encode([
                "status" => "error",
                "message" => "Database error"
            ]));
        }
        $this->closeConnection();
        $fetch = $query->fetch(PDO::FETCH_OBJ);
        return $fetch;
    }
}
