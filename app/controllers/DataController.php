<?php
class DataController
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
}
