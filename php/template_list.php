<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 22:11
 */

header('Context-Type:text/json;charset=UTF-8');
class requestResponse {
    public $Status = "";
    public $StatusCode = "";
    public $Description="";
    public $Error = "";
    public $Ret_Data=array(

    );
}
include_once'json_admin.php';
$retResult = new requestResponse();//一个返回对象
$template=array(
    "title"=>"",
    "c_time"=>"",
    "template_id"=>"",
    "distribution1_num"=>''  //不清楚这个是什么
);
$sql='SELECT * FROM tbl_quetemplate  ';
if($result=mysqli_query($dbcon,$sql))
{
    $retResult->Status= "success";
    $retResult->StatusCode = 1;
    $retResult->Description="";
    $retResult->Error="";
    while($row=$result->fetch_assoc())
    {
        $template['template_id']=$row['template_id'];
        $template['c_time']=$row['c_time'];
        $template['template_title']=$row['template_title'];
        array_push($retResult->Ret_Data, $template);
    }
    mysqli_free_result($result);
    $dbcon->close();
    exit(json_encode($retResult));

}
else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息

}

