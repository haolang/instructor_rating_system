<?php
include_once 'php_lib/global_src.php';
$dbcon=mysqli_connect($_G_DB_SERVER,'test','testqwe147',$_G_DB_NAME);
if($dbcon->connect_error){
    die('{"status":"failed","reason":"'.$dbcon->connect_error.'"}');
}
//设置这个连接以及返回结果的编码方式，解决中文乱码问题
mysqli_query($dbcon, "SET NAMES 'utf8mb4'");

