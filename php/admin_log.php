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

class requestResponse {
    public $Status = "";
    public $StatusCode = "";
    public $Description="";
    public $Error = "";
    public $Ret_Data=array(
        "admin_id"=>"",
        "admin_name"=>"",
    );
}
header('Content-Type:text/json');
$retResult = new requestResponse();//一个返回对象
if(isset($_POST['id']) && isset($_POST['password']) &&
!empty($_POST['id']) && !empty($_POST['password'])){
    include_once'json_admin.php';
    $id         =   $dbcon->real_escape_string($_POST['id']);
    $password   =   $dbcon->real_escape_string($_POST['password']);
    $sql = "select * from tbl_admin where admin_name= '".$id."'and admin_pass='".md5($password)."'";
    if($result=mysqli_query($dbcon,$sql))
    {
        if($row = mysqli_fetch_array($result))
        {
            session_start();
            $_SESSION["admin_id"]=$row['admin_id'];
            $_SESSION["admin_name"]=$row['admin_name'];//登陆成功,设置session.
            $retResult->StatusCode = 1;
            $retResult->Status = 'success';
            $retResult->Ret_Data['admin_id'] = $row['admin_id'];
            $retResult->Ret_Data['admin_name'] = $row['admin_name'];
            include 'php_lib/getRemoteIP.php';
            setLogToDB($dbcon,$row['admin_name']."登陆",$row['admin_id']);
        }
        else//登陆失败 用户名或密码错误
        {
            $retResult->StatusCode = 0;
            $retResult->Status = 'failed';
            $retResult->Error = '用户名或者密码不正确';
        }
    }
    else{
        $retResult->StatusCode = 0;
        $retResult->Status = 'failed';
        $retResult->Error = '数据库查询出错';
    }
    $dbcon->close();
}else{
    $retResult->StatusCode = 0;
    $retResult->Status = 'failed';
    $retResult->Error = '请求参数有误';
}
echo json_encode($retResult);
