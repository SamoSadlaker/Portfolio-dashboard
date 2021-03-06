<?php
class DataController extends DatabaseController
{
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function checkPassword($password)
    {
        $return = "success";
        if (!preg_match("#[0-9]+#", $password)) {
            $return = "number";
        }

        if (!preg_match("#[a-z]+#", $password)) {
            $return = "letter";
        }

        if (!preg_match("#[A-Z]+#", $password)) {
            $return = "upper";
        }

        if (!preg_match("/[\'^£$%&*()}{@#~?><>,:|=_+!-]/", $password)) {
            $return = "special";
        }
        return $return;
    }

    public function downloadImage($url, $uuid)
    {
        $image = file_get_contents($url);
        if ($image) {
            $random = substr(sha1(rand()), 0, 8);
            $location = ROOT . "assets" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "profile" . DIRECTORY_SEPARATOR;
            $image_name = $uuid . "_" . $random . ".svg";

            $save = fopen($location . $image_name, "w");
            fwrite($save, $image);
            fclose($save);

            return $image_name;
        }
    }
    public function getPosition($type)
    {
        switch ($type) {
            case 0:
                return "Default";
                break;
            case 1:
                return "Admin";
                break;
            case 2:
                return "Owner";
                break;
        }
    }

    public function getUsers()
    {
        $query = $this->openConnection()->prepare("SELECT `id`,`uuid`,`name`,`lastname`,`username`,`email`,`type`,`verified` FROM `users`");
        $query->execute();
        $alert = new AlertController();
        $routing = new RoutingController();

        if (!$query) {
            $this->closeConnection();
            $alert->addAlert("error", "Database error.");
            $routing->redirect("/");
        }

        $this->closeConnection();
        $fetch = $query->fetchAll(PDO::FETCH_OBJ);
        return $fetch;
    }
    public function getTickets($user)
    {
        $query = $this->openConnection()->prepare("SELECT * FROM `ticket` WHERE `from_user`=:id");
        $query->bindParam(":id", $user, PDO::PARAM_INT);
        $query->execute();
        $alert = new AlertController();
        $routing = new RoutingController();

        if (!$query) {
            $this->closeConnection();
            $alert->addAlert("error", "Database error.");
            $routing->redirect("/");
        }

        $this->closeConnection();
        $fetch = $query->fetchAll(PDO::FETCH_OBJ);
        return $fetch;
    }
    public function getOrders($user)
    {
        $query = $this->openConnection()->prepare("SELECT * FROM `orders` WHERE `user`=:id");
        $query->bindParam(":id", $user, PDO::PARAM_INT);
        $query->execute();
        $alert = new AlertController();
        $routing = new RoutingController();

        if (!$query) {
            $this->closeConnection();
            $alert->addAlert("error", "Database error.");
            $routing->redirect("/");
        }

        $this->closeConnection();
        $fetch = $query->fetchAll(PDO::FETCH_OBJ);
        return $fetch;
    }
    public function getInvoices($user)
    {
        $query = $this->openConnection()->prepare("SELECT * FROM `invoice` WHERE `user`=:id");
        $query->bindParam(":id", $user, PDO::PARAM_INT);
        $query->execute();
        $alert = new AlertController();
        $routing = new RoutingController();

        if (!$query) {
            $this->closeConnection();
            $alert->addAlert("error", "Database error.");
            $routing->redirect("/");
        }

        $this->closeConnection();
        $fetch = $query->fetchAll(PDO::FETCH_OBJ);
        return $fetch;
    }
    public function getStats()
    {
        $query = $this->openConnection()->prepare("SELECT COUNT(`id`) FROM `users` UNION ALL SELECT COUNT(`id`) FROM `orders` UNION ALL SELECT COUNT(`id`) FROM `ticket`");
        $query->execute();
        $alert = new AlertController();
        $routing = new RoutingController();

        if (!$query) {
            $this->closeConnection();
            $alert->addAlert("error", "Database error.");
            $routing->redirect("/");
        }

        $this->closeConnection();
        $fetch = $query->fetchAll(PDO::FETCH_COLUMN);
        return $fetch;
    }
}
