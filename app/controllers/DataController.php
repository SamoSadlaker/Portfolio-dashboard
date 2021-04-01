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

    public function downloadImage($url)
    {
        $image = file_get_contents($url);
        if($image){
            $random = substr(sha1(rand()), 0, 8);
            $location = ROOT . "assets" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "profile". DIRECTORY_SEPARATOR;
            $image_name = $random . ".svg";

            $save = fopen($location . $image_name, "w");
            fwrite($save, $image);
            fclose($save);

            return $image_name;
        }
    }
}
