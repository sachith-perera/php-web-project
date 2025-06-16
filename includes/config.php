<?php 

$servername = "localhost";
$username = "sachith";
$password = "Welcome1";
$dbname = "sjh_db";

$db = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8',$username,$password);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

define('APP_NAME','MH Care');

?>