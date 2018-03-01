
<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 21:42
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
session_start();
if (isset($_SESSION["stu_name"]) && !empty($_SESSION["stu_name"]) &&
    isset($_SESSION["stu_no"]) && !empty($_SESSION["stu_no"]) &&
    isset($_SESSION["stu_ybid"])&&!empty($_SESSION["stu_ybid"])
)
{//如果成功
    $retResult->Status= "success";
    $retResult->StatusCode = 1;
    $retResult->Description="";
    $retResult->Error="";
    $retResult->Ret_Data["s_ybid"]=$_SESSION["stu_ybid"];
    $retResult->Ret_Data["s_stuid"]=$_SESSION["stu_no"];
    $retResult->Ret_Data["s_name"]=$_SESSION["stu_name"];
    exit(json_encode($retResult));
}
else
{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="未登录";
    $retResult->Ret_Data="";
    exit(json_encode($retResult));//失败返回相关信息
}