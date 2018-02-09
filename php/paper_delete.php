<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 23:59
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
$paper_id=$_POST['paper_id'];
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
if(!empty($paper_id))
{
    $sql=" DELETE FROM tbl_quepublish WHERE  publish_id='".$paper_id."'";
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
        $retResult->Error="failed in sql delete table tbl_quepublish(paper_id) ";
        $retResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($retResult));//失败返回相关信息

    }

}
else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="接收不到问卷id";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息

}