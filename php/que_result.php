<?php
/**
 * Created by Php
 * Storm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 9:43
 */
//存入问卷结果函数
class requestResponse {
    public $Status = "";
    public $StatusCode = "";
    public $Description="";
    public $Error = "";
    public $Ret_Data="";
}

$retResult = new requestResponse();//一个返回对象
include_once'json_student.php';
$answer_total="";
foreach ($_GET as $key => $value) {
    $answer_num=substr($key,4);//获取qid后面的题目号并且存入字符串
    if($answer_num!=null)
    {
        $answer_total=$answer_total.$answer_num.";";
    }
}
session_start();
$answer_total=substr($answer_total,0,-1);//去除末尾最后一个：
if (isset($_SESSION["stu_name"]) && !empty($_SESSION["stu_name"]) &&
    isset($_SESSION["stu_no"]) && !empty($_SESSION["stu_no"]) &&
    isset($_SESSION["stu_ybid"])&&!empty($_SESSION["stu_ybid"])
)
{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;

    $retResult->Description="";
    $retResult->Error="未登录";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信
}
else
{
    $s_ybid=$_SESSION['s_ybid'];//在que_list里设置了session？
    $paper_id=$_SESSION['paper_id'];
}
$flag="";//用作输出的参数
$sql="call counselorquestionnaire.sp_save_que('".$s_ybid."','".$paper_id. "','".$answer_total."',@flag) ";
if(mysqli_query($dbcon ,$sql))
{
    if($flag==1)
    {
        $retResult->Status= "success";
        $retResult->StatusCode = 1;
        $retResult->Description="success save";
        $retResult->Error="";
        $retResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($retResult));//存储完成
    }
    else if($flag==0)
    {
        $retResult->Status= "failed";
        $retResult->StatusCode = 0;
        $retResult->Description="";
        $retResult->Error="sp_save_que excutes wrongly";
        $retResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($retResult));//失败返回相关信息

    }
}
else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="sp_save_que excutes wrongly";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息
}
