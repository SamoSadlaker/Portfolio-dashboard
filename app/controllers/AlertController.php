<?php
class AlertController
{
    public function showAlerts()
    {
        $return = "";
        if (isset($_SESSION['notification']) && !empty($_SESSION['notification'])) {
            $notification = json_decode($_SESSION['notification']);
            foreach ($notification as $item) {
                $return .= "<div class='notification-{$item->status}'>{$item->message} <i class='bx bx-x'></i></div>";
            }
        }
        return $return;
    }

    public function addAlert($status, $message)
    {
        if (isset($_SESSION['notification']) && !empty($_SESSION['notification'])) {
            $array = json_decode($_SESSION['notification']);
            array_push($array, ["status" => $status, "message" => $message]);
            $_SESSION['notification'] = json_encode($array);
        } else {
            $_SESSION['notification'] = json_encode([
              ["status" => $status, "message" => $message],
        ]);
        }
    }

    public function clearAlerts()
    {
        if (isset($_SESSION['notification']) && !empty($_SESSION['notification'])) {
            $_SESSION['notification'] = "";
        }
    }
}
