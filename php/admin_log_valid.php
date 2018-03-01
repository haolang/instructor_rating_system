
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
if (isset($_SESSION["admin_id"]) && !empty($_SESSION["admin_id"]) &&
    isset($_SESSION["admin_name"])&&!empty($_SESSION["admin_name"])
)
{//如果成功
    $retResult->Status= "success";
    $retResult->StatusCode = 1;
    $retResult->Description="";
    $retResult->Error="";
    $retResult->Ret_Data["admin_id"]=$_SESSION["admin_id"];
    $retResult->Ret_Data["admin_name"]=$_SESSION["admin_name"];
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