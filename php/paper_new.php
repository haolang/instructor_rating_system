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
$retResult = new requestResponse();//一个返回对象
$paper_title=$_POST['paper_title'];
$template_id=$_POST['template_id'];
session_start();
if (!(isset($_SESSION["admin_id"]) && !empty($_SESSION["admin_id"]) &&
    isset($_SESSION["admin_name"]) && !empty($_SESSION["admin_name"]))
)//登陆判断如果没有登陆，是否需要跳转***oauth_log.php
{
    $retResult->Status = "failed";
    $retResult->StatusCode = 0;
    $retResult->Description = "";
    $retResult->Error = "管理员未登录";
    $retResult->Ret_Data = "";
    exit(json_encode($retResult));//失败返回相关信息
}
if(!empty($paper_title) && !empty($template_id))
{
    include_once'json_admin.php';
    $sql='insert into tbl_quepublish (template_id, publish_title, alert_info, is_enable) VALUES
          ("'.$template_id.'","'.$paper_title.'","无","0")';
    if($dbcon->query($sql))
    {
        $retResult->Status= "success";
        $retResult->StatusCode = 1;
        $retResult->Description="";
        $retResult->Error="";
        $retResult->Ret_Data=array(
            "paper_id"=>$dbcon->insert_id,
            "template_id"=>$template_id
        );
        include 'php_lib/getRemoteIP.php';
        setLogToDB($dbcon,$_SESSION["admin_name"]."由id为".$template_id."的模板新建了id为".$dbcon->insert_id."的问卷《".$paper_title."》",$_SESSION['admin_id']);
    }
    else {
        $retResult->Status= "failed";
        $retResult->StatusCode = 0;
        $retResult->Description="";
        $retResult->Error="fail in creating new paper:".$dbcon->error;
        $retResult->Ret_Data="";
    }

    $dbcon->close();
}
else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="lose parameter paper_title or template_id";//缺少参数
    $retResult->Ret_Data="";
}
echo(json_encode($retResult));