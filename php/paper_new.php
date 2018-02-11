<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 23:38
 */
class requestResponse {
    public $Status = "";
    public $StatusCode = "";
    public $Description="";
    public $Error = "";
    public $Ret_Data="";
}
include_once'json_admin.php';
$retResult = new requestResponse();//一个返回对象
$paper_title=$_POST['paper_title'];
$template_id=$_POST['template_id '];
if (!isset($_SESSION["admin_id"]) || !empty($_SESSION["admin_id"])||
    !isset($_SESSION["admin_name"])||!empty($_SESSION["admin_name"])
)//登陆判断如果没有登陆，是否需要跳转***oauth_log.php
{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="管理员未登录";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息
}
if(!empty($paper_title)&&!empty($template_id))
{
    $sql='insert into tbl_quepublish (template_id,publsh_title,alert_info,is_enable)
     VALUES (\''.$template_id.'\',\''.$paper_title.'\',0,1)';//默认增加的问卷为启用？
    if(mysqli_query($dbcon,$sql))
    {
        $retResult->Status= "success";
        $retResult->StatusCode = 1;
        $retResult->Description="";
        $retResult->Error="";
        $retResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($retResult));

    }
    else {
        $retResult->Status= "failed";
        $retResult->StatusCode = 0;
        $retResult->Description="";
        $retResult->Error="fail in creating new paper";
        $retResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($retResult));//失败返回相关信息

    }
    $retResult->Status= "success";
    $retResult->StatusCode = 1;
    $retResult->Description="";
    $retResult->Error="";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));

}
else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="lose parameter paper_title or template_id";//缺少参数
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息

}