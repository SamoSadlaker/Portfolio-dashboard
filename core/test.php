<?php
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("APP_ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR . "app". DIRECTORY_SEPARATOR);
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";

$data = new DataController();

var_dump($data->downloadImage("https://eu.ui-avatars.com/api/?name=SamoSadlaker&background=random&color=fff&rounded=false&bold=true&format=svg"));
