<?php

$notifications = [
  ["status" => "error", "message" => "LOL"],
];
$array = json_encode($notifications, false);

var_dump(json_decode($array));
