<?php
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("APP_ROOT", ROOT . "app". DIRECTORY_SEPARATOR);

require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DatabaseController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "DataController.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "AuthController.php";


$database = new DatabaseController();
$data = new DataController();
$auth= new AuthController();

if($data->isAjax()){

  if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK){
    $tmpPath = $_FILES["file"]['tmp_name'];
    $name = $_FILES["file"]['name'];
    $size = $_FILES["file"]['size'];
    
    $path_parts = pathinfo($name);
    $extension = $path_parts['extension'];

    $alowedExtensions = array("jpg", "jpeg", "png");

    if(in_array($extension, $alowedExtensions)){
      
      if($size < 6250000 ){
        session_start();
        $newName = $_SESSION['uuid'] . "_" . $auth->generateStr(6) . "." . $extension;

        if(move_uploaded_file($tmpPath, ROOT . "assets" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "profile" . DIRECTORY_SEPARATOR . $newName)){


          $query = $database->openConnection()->prepare("UPDATE `users`  SET `image` = :image WHERE `id`=:id ");
          $query->bindParam(":image", $newName, PDO::PARAM_STR);
          $query->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);

          $query->execute();

          if (!$query) {
              $database->closeConnection();
              return json_decode([
                "status" => "error",
                "message" => "Database error"
            ]);
          }
          $database->closeConnection();
          die(json_encode([
            "status" => "success",
            "message" => "Your profile picture successfuly uploaded."
          ]));
        } else {
          die(json_encode([
            "status" => "error",
            "message" => "Something wrong with uploading."
          ]));
        }

      } else {
        die(json_encode([
          "status" => "error",
          "message" => "Uploaded file is too large."
        ]));
      }
    } else {
      die(json_encode([
        "status" => "error",
        "message" => "This file has unsuported extension."
      ]));
    }

   

  } else {
    die(json_encode([
      "status" => "error",
      "message" => "Form is emtpy."
    ]));
  }

  
  

} else {
  die(json_encode([
    "status" => "error",
    "message" => "Request is invalid."
  ]));
}