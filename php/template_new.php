<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 22:36
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
if(!empty($_POST['template_name'])&&!empty($_POST['q_1_content']&&!empty('q_1_score')))
{
    $template_name=$_POST['template_name'];
    $t =date('Y-m-d H:i:s');
    $sql='insert into tbl_quetemplate (template_title,c_time)
    VALUES (\''.$template_name.'\',\''.$t.'\')';//  插入到表tbl_quetemplate中
    if(mysqli_query($dbcon,$sql))
    {
        $sql="select * from tbl_quetemplate  ORDER BY template_id publish_id DESC ";
        if($result = mysqli_query($dbcon, $sql))
        {
            $row = $result->fetch_assoc();
            $template_id=$row['template_id'];
        }
        foreach ($_POST as $key => $value) {//发送的参数格式{(内容，分数),()}
            $cognizz=substr($key,-7);//获取qid后面的题目号并且存入字符串
            if($cognizz=='content')
            {
                $cut=strpos($key, '_');
                $quescore='q_'.$cut[1].'_score';
                $score=$_POST[$quescore];//分数为指定的接收到的
                $sql='insert into tbl_queitems (template_id,content,scores)
            VALUES (\''.$template_id.'\',\''.$value.'\',\''.$score.'\')';//  插入到表tbl_quetemplate中
                if(!mysqli_query($dbcon,$sql))
                {
                    $retResult->Status= "failed";
                    $retResult->StatusCode = 0;
                    $retResult->Description="";
                    $retResult->Error="插入到 tbl_queitems（表）sql语句执行错误";
                    $retResult->Ret_Data="";
                    $dbcon->close();
                    exit(json_encode($retResult));//失败返回相关信息


                }

            }
            else
            {
                continue;
            }

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
        $retResult->Error="插入到模板（表）sql语句执行错误";
        $retResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($retResult));//失败返回相关信息

    }

}
else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="template_new.php缺少参数";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息
}