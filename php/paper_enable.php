<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/22
 * Time: 0:05
 */
class requestResponse {
    public $Status = "";
    public $StatusCode = "";
    public $Description="";
    public $Error = "";
    public $Ret_Data="";
}
$retResult = new requestResponse();//一个返回对象

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
if(isset($_GET['paper_id']) && preg_match('/[0-9]{1,}/',$_GET['paper_id']))
{
    include_once 'json_admin.php';
    $paper_id = $_GET['paper_id'];
    //利用函数禁用问卷（改变为相反的值）
    $sql="select * from tbl_quepublish WHERE  publish_id='".$paper_id."'";
    if($result=mysqli_query($dbcon,$sql))
    {
        $row = $result->fetch_assoc();
        $able = $row['is_enable'];
        mysqli_free_result($result);
        $dbcon->begin_transaction();
        $dbcon->autocommit(false);
        if($able==0)
        {
            $sql="UPDATE tbl_quepublish SET is_enable = 1 WHERE publish_id = '".$paper_id."'";
            $sql2="UPDATE tbl_quepublish SET is_enable = 0 WHERE publish_id != '".$paper_id."'";
            $dbcon->query($sql);
            $dbcon->query($sql2);
        }
        else if($able==1)
        {
            $sql="UPDATE tbl_quepublish SET is_enable = 0 WHERE publish_id = '".$paper_id."'";
            $dbcon->query($sql);
        }
//判断执行过程是否出错，如果语句都执行成功则提交事务，否则回滚事务
        if (!$dbcon->errno) {
            $dbcon->commit();
            $retResult->Status = "success";
            $retResult->StatusCode = 1;
            $retResult->Description = "";
            $retResult->Error = "";
            $retResult->Ret_Data = "";
        } else {
            $dbcon->rollback();
            $retResult->Status = "failed";
            $retResult->StatusCode = 0;
            $retResult->Description = "";
            $retResult->Error = "数据库执行出错".$dbcon->error;
            $retResult->Ret_Data = "";
        }
        $dbcon->close();
    }
    else{
        $retResult->Status= "failed";
        $retResult->StatusCode = 0;
        $retResult->Description="";
        $retResult->Error="数据库查询问卷id失败";
        $retResult->Ret_Data="";
        $dbcon->close();
    }
}
else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="get接收到的参数为空";
    $retResult->Ret_Data="";
}
echo json_encode($retResult);
