<?php

class RoutingController
{
    public function routing($url)
    {
        require_once APP_ROOT . "settings.php";
        if (empty($url)) {
            require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "#default.php";
        }

        if (in_array($url, ["index", "chat", "ticket", "settings"])) {
            require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . $url . ".php";
        } else {
            require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "#" . $url . ".php";
        }

        require_once APP_ROOT . "pages" . DIRECTORY_SEPARATOR . "#default.php";
    }
}
