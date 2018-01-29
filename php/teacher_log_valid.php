<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 11:44
 */
class requestResponse {
    public $Status = "";
    public $StatusCode = "";
    public $Description="";
    public $Error = "";
    public $Ret_Data=array(
        "t_ybid"=>"",
        "t_name"=>"",
    );
}
header('Content-Type:text/json');
$retResult = new requestResponse();//一个返回对象
session_start();
if (isset($_SESSION["t_ybid"]) && !empty($_SESSION["t_ybid"])+
    isset($_SESSION["t_name"])&&!empty($_SESSION["t_name"])
)
{//如果成功
    $retResult->Status= "success";
    $retResult->StatusCode = 1;
    $retResult->Description="";
    $retResult->Error="";
    $retResult->Ret_Data["t_ybid"]=$_SESSION["t_ybid"];
    $retResult->Ret_Data["t_name"]=$_SESSION["t_name"];
    exit(json_encode($retResult));
}
else
{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="有session为空";
    $retResult->Ret_Data="";
    exit(json_encode($retResult));//失败返回相关信息
}
