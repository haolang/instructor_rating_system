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
include_once'json_admin.php';
$retResult = new requestResponse();//一个返回对象
$template_id=$_GET['template_id'];//
if(!empty($template_id))
{
    $sql='SELECT * FROM tbl_quetemplate WHERE template_id = "'.$template_id.'"';//利用教师yb_id来查找其身份
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

