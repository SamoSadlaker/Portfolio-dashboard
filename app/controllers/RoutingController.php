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

        if (in_array($url, ["index", "chat", "ticket", "settings"])) {
            $routing = $this;
            $page = $url;
            require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "_layout.php";
        } else {
            if (file_exists(APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "#" . $url . ".php")) {
                require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "#" . $url . ".php";
            } else {
                $this->redirect("/");
            }
        }
    }

    public function getContent($page)
    {
        if (file_exists(APP_ROOT . "pages" . DIRECTORY_SEPARATOR . $page . ".php")) {
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