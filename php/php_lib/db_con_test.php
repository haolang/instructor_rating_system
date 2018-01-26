<?php
/**
 * Created by PhpStorm.
 * User: Linker
 * Date: 2018/1/26
 * Time: 13:20
 */
include 'global_src.php';

$db_username = "test";//用户名
$db_password = "testqwe147";//密码

//连接数据库
$db_con = mysqli_connect("$_G_DB_SERVER", "$db_username", "$db_password", "$_DB_NAME");
if ($db_con->connect_error)
{
    die('<script>alert('.$_G_ERROR_TEXT['db']['con'].')</script>');
}
//设置这个连接以及返回结果的编码方式，解决中文乱码问题
if(!$db_con->query("SET NAMES 'utf8'")){
    $db_con->close();
    die('<script>alert('.$_G_ERROR_TEXT['db']['query'].')</script>');
}