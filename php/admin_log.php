<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/19
 * Time: 23:59
 * 登陆成功跳转到admin.php
 * 登陆失败提示错误信息重新登录

 *html
 * 管理员登录界面
 * 账号为id，密码为password
 */
include_once'json_admin.php';
$id=$_POST['id'];
$password=$_POST['password'];
$sql="select*from tbl_admin where admin_name= '".$id."'and admin_pass='".$password."'";
if($result=mysqli_query($dbcon,$sql))
{
    if(mysqli_fetch_array($result))
    {
        $_SESSION["admin_id"]=$id;
        $_SESSION["admin_name"]=$password;//登陆成功,设置session.
        // echo "嗯，果然有数据！";
        header('Location: admin.php');//跳转到admin.php (依次执行模块文档里面的内容，先发送给admin_log_valid)
    }
    else//登陆失败 用户名或密码错误
    {
        header('Location: admin_log.php');


    }
}
else{
    echo"数据库查询失败";
}