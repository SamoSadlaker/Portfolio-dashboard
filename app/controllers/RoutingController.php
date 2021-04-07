<?php

class RoutingController
{
    public function getPage()
    {
        if (empty($_GET['url'])) {
            $url = "index";
        } else {
            $url = $_GET['url'];
        }

        require APP_ROOT . "settings.php";
        if (in_array($url, $pages)) {
            $routing = $this;
            $page = $url;
            $database = new DatabaseController();
            $auth = new AuthController();
            $data = new DataController();
            $mail = new MailController();
            $alert = new AlertController();
            require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "_layout.php";
        } else {
            if (file_exists(APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "#" . $url . ".php")) {
                $routing = $this;
                $page = $url;
                $database = new DatabaseController();
                $auth = new AuthController();
                $data = new DataController();
                $mail = new MailController();
                $alert = new AlertController();
                require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "#" . $url . ".php";
            } else {
                $this->redirect("/");
            }
        }
    }

    public function getScript()
    {
        $return = "";
        if (empty($_GET['url'])) {
            $page = "index";
        } else {
            $page = $_GET['url'];
        }
        if (file_exists(ROOT . "assets" . DIRECTORY_SEPARATOR . "js" . DIRECTORY_SEPARATOR . $page . ".js")) {
            $return = '<script src="assets/js/' . $page . '.js"></script>';
        }

        return $return;
    }

    public function getContent($page)
    {
        if (file_exists(APP_ROOT . "pages" . DIRECTORY_SEPARATOR . $page . ".php")) {
            $routing = $this;
            $database = new DatabaseController();
            $auth = new AuthController();
            $data = new DataController();
            $mail = new MailController();
            $alert = new AlertController();
            require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . $page . ".php";
        }
    }

    public function getPageName()
    {
        if (empty($_GET['url'])) {
            $name = "Home";
        } else {
            $name = $_GET['url'];
        }
        return ucfirst($name);
    }

    public function redirect($url)
    {
        header("Location: " . $url);
    }
}
