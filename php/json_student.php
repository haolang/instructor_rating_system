<?php
$dbcon=mysqli_connect('45.78.24.43','test','testqwe147','counselorquestionnaire');
if($dbcon->connect_error){
    die('{"status":"failed","reason":"'.$dbcon->connect_error.'"}');
}
//设置这个连接以及返回结果的编码方式，解决中文乱码问题
mysqli_query($dbcon, "SET NAMES 'utf8mb4'");

