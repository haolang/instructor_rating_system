<?php
/**
 * Created by PhpStorm.
 * User: Shinelon
 * Date: 2018/2/7
 * Time: 15:01
 */
/*
//todo 测试暂时使用
echo '{
    "Status":"success",
    "StatusCode":1,
    "Description":"",
    "Error":"",
    "Ret_Data":[
        {
            "q_id":1,
            "content":"将数据存储于数据库2",
            "score":10,
            "selectors":[
                {
                    "s_id":1,
                    "mark":"A",
                    "content":"好",
                    "percent":95
                },
                {
                    "s_id":2,
                    "mark":"B",
                    "content":"一般",
                    "percent":80
                }
            ]
        },
        {
            "q_id":2,
            "content":"将数据存储库2",
            "score":10,
            "selectors":[
                {
                    "s_id":1,
                    "mark":"A",
                    "content":"好",
                    "percent":95
                },
                {
                    "s_id":2,
                    "mark":"B",
                    "content":"一般",
                    "percent":80
                }
            ]
        }
    ]
}';
*/
//具体模板的题目及选项
class queResponse
{
    public $Status = "";
    public $StatusCode = "";
    public $Description = "";
    public $Error = "";
    public $Title="";//新增
    public $Ret_Data = array(

    );
}
$queOne= array(
    "q_id"=>"",
    "content"=>"",
    "score"=>"",
    "selectors"=>array(

    )
);
$queSelector=array(
    "s_id"=>"",
    "mark"=>"",
    "content"=>"",
    "percent"=>'',
);
include_once'json_admin.php';
$queResult = new queResponse();//一个返回对象
$new="";
/*if (!isset($_SESSION["admin_id"]) || empty($_SESSION["admin_id"])||
    !isset($_SESSION["admin_name"])||empty($_SESSION["admin_name"])
)//登陆判断如果没有登陆，是否需要跳转***oauth_log.php
{
    $queResult->Status= "failed";
    $queResult->StatusCode = 0;
    $queResult->Description="";
    $queResult->Error="管理员未登录";
    $queResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($queResult));//失败返回相关信息
}*/
if(!empty($_GET['template_id']))
{   $template_id=mysqli_real_escape_string($dbcon,$_GET['template_id']);
    $sql='SELECT * FROM tbl_quetemplate WHERE template_id = "'.$template_id .'"';
    if($result=mysqli_query($dbcon,$sql)) {
        $queResult->Status = "success";
        $queResult->StatusCode = 1;
        $queResult->Description = "";
        $queResult->Error = "";
        if ($row = $result->fetch_assoc())//取一行作为关联数组
        {
            $queResult->Title = $row['template_title'];
        } else {
            $queResult->Status = "failed";
            $queResult->StatusCode = 0;
            $queResult->Description = "";
            $queResult->Error = "数据库内不存在该template_id";
            $queResult->Ret_Data = "";
            $dbcon->close();
            exit(json_encode($queResult));//失败返回相关信息

        }
        $sqlone = 'SELECT * FROM tbl_queitems WHERE template_id = "' . $template_id . '"';
        if ($result1 = mysqli_query($dbcon, $sqlone)) {
            while ($row1 = $result1->fetch_assoc())//取一行作为关联数组,遍历所有模板号相同的que_id
            {
                $que_id = $row1['que_id'];
                $queOne['q_id'] = $que_id;
                $queOne['content'] = $row1['content'];
                $queOne['score'] = $row1['scores'];
                array_push($queResult->Ret_Data, $queOne);// 将该题目的内容分数等，即数组q_one添加入数组$queone
                $sqltwo = 'SELECT * FROM tbl_queselectors WHERE que_id = "' . $que_id . '"';
                if ($result2 = mysqli_query($dbcon, $sqltwo)) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $queSelector['s_id'] = $row2['selector_id'];//题目的选项、标识、百分比
                        $queSelector['mark'] = $row2['selector_mark'];
                        $queSelector['percent'] = $row2['score_percent'];
                        $queSelector['content'] = $row2['content'];
                        array_push($queResult->Ret_Data[count($queResult->Ret_Data) - 1]['selectors'], $queSelector);//array_push每一题的选项
                    }
                } else {
                    $queResult->Status = "failed";
                    $queResult->StatusCode = 0;
                    $queResult->Description = "";
                    $queResult->Error = "SELECT * FROM tbl_queselectors WHERE que_id 执行操作";
                    $queResult->Ret_Data = "";
                    $dbcon->close();
                    exit(json_encode($queResult));//失败返回相关信息
                }
            }
            $dbcon->close();
            exit(json_encode($queResult));//成功返回
        } else {
            $queResult->Status = "failed";
            $queResult->StatusCode = 0;
            $queResult->Description = "";
            $queResult->Error = "SELECT * FROM tbl_queitems WHERE template_id 执行错误";
            $queResult->Ret_Data = "";
            $dbcon->close();
            exit(json_encode($queResult));//失败返回相关信息
        }
    }
    else{
        $queResult->Status = "failed";
        $queResult->StatusCode = 0;
        $queResult->Description = "";
        $queResult->Error = "SELECT * FROM tbl_quetemplate WHERE template_id 执行失败";
        $queResult->Ret_Data = "";
        $dbcon->close();
        exit(json_encode($queResult));//失败返回相关信息
    }
}
else{
    $queResult->Status = "failed";
    $queResult->StatusCode = 0;
    $queResult->Description = "";
    $queResult->Error = "";
    $queResult->Ret_Data = "_GET[template_id参数为空";
    $dbcon->close();
    exit(json_encode($queResult));//失败返回相关信息
}