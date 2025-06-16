<?php
session_start();
 //headers
 header('Access-Control-Allow-Origin:*');
 header('Content-Type:application/json');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
 header('Access-Control-Allow-Methods: POST');

//initializing API
 include_once('../core/initialize.php');

 $user = new User($db);

 //get posted data
 $data = json_decode(file_get_contents("php://input"));

 $user->username = $data->username;

 $user->get_data();

 if ($data->username == $user->username && $data->password == $user->password) {
    $_SESSION['user'] = $user->name;
    $_SESSION['username'] = $user->username;
    session_commit();
  echo (json_encode(array("id"=>1,"status"=> "success","message"=> "login success","userName"=>$user->name)));
 }else{
  echo (json_encode(array("id"=> 0,"status"=> "error","message"=> "invalid login")));
 }

  
?>