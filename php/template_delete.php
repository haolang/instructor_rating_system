<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 23:32
 */

class requestResponse {
    public $Status = "";
    public $StatusCode = "";
    public $Description="";
    public $Error = "";
    public $Ret_Data="";
}

$retResult = new requestResponse();//一个返回对象
$template_id=$_GET['template_id'];//
session_start();
if (!(isset($_SESSION["admin_id"]) && !empty($_SESSION["admin_id"]) &&
    isset($_SESSION["admin_name"]) && !empty($_SESSION["admin_name"])
))//登陆判断如果没有登陆，是否需要跳转***oauth_log.php
{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="管理员未登录";
    $retResult->Ret_Data="";
    exit(json_encode($retResult));//失败返回相关信息
}
include_once'json_admin.php';
if(!empty($template_id))
{
    $sql='DELETE  FROM tbl_quetemplate WHERE template_id = "'.$template_id.'"';//利用教师yb_id来查找其身份
    if($result=mysqli_query($dbcon,$sql))
    {
        $retResult->Status = "success";
        $retResult->StatusCode = 1;
        $retResult->Description = "";
        $retResult->Error = "";
        $retResult->Ret_Data = "";
        $dbcon->close();
        exit(json_encode($retResult));
    }
    else{
        $retResult->Status= "failed";
        $retResult->StatusCode = 0;
        $retResult->Description="";
        $retResult->Error="sql语句执行出错";
        $retResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($retResult));//失败返回相关信息

    }

}
else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="template_delete.php参数缺少";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息
}

