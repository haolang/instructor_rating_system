<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/20
 * Time: 14:01
 */
class queResponse
{
    public $Status = "";
    public $StatusCode = "";
    public $Description = "";
    public $Title="";
    public $Error = "";
    public $Ret_Data = array(

    );
}

/*该数据用来测试
  echo '{
    "Status":"success",
    "StatusCode":1,
    "Description":"",
        "Title":"四川师范大学辅导员工作学生调查问卷",
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
include_once'json_student.php';
$queResult = new queResponse();//一个返回对象
$new="";
if(!empty($_GET['que_id']))//返回指定的问卷
{
    session_start();
    //注册session变量，方便在que_result中接收填写的是哪份问卷
    $_SESSION["paper_id"]=$_GET['que_id'];
    $sqlone='SELECT * FROM counselorquestionnaire.view_publish_selectoritems WHERE publish_id = "'. $_GET['que_id'] .'"';
    $new="";
    if($result=mysqli_query($dbcon,$sqlone))
    {
        $sql='SELECT * FROM tbl_quepublish WHERE publish_id = "'. $_GET['que_id'] .'"';
        if($result=mysqli_query($dbcon,$sql)) {
            $row=$result->fetch_assoc();
            $queResult->Title=$row['publsh_title'];
        }
        $queResult->Status= "success";
        $queResult->StatusCode = 1;
        $queResult->Description="";
        $queResult->Error="";
        while($row=$result->fetch_assoc())//取一行作为关联数组
        {
            if($new!=$row['que_id'])//通过published_id获取的到q_id
            {
                $queOne['q_id']=$row['que_id'];
                $new=$row['que_id'];
                $sqltwo="select * from counselorquestionnaire.view_published_que WHERE  publish_id='".$_GET['que_id']."' and que_id='".$row['que_id']."'";
                if($resulttwo=mysqli_query($dbcon,$sqltwo))
                {

                    $rowtwo=$resulttwo->fetch_assoc();
                    $queOne['content']=$rowtwo['content'];
                    $queOne['score']=$rowtwo['scores'];
                    array_push( $queResult->Ret_Data,$queOne);// 将该题目的内容分数等，即数组q_one添加入数组$queResult->Ret_Data
                    mysqli_free_result($resulttwo);
                }
                else{
                    $queResult->Status="failed";
                    $queResult->StatusCode=0;
                    $queResult->Description="";
                    $queResult->Error="数据库查询出错";
                    $queResult->Ret_Data="";
                    $dbcon->close();
                    exit(json_encode($queResult));//失败返回相关信息
                }
            }
            $queSelector['s_id']=$row['selector_id'];//题目的选项、标识、百分比
            $queSelector['mark']=$row['selector_mark'];
            $queSelector['percent']=$row['score_percent'];
            array_push($queResult->Ret_Data[count($queResult->Ret_Data)-1]['selectors'],$queSelector);//array_push每一题的选项
        }
        mysqli_free_result($result);

    }
    else
    {
        $queResult->Status="failed";
        $queResult->StatusCode=0;
        $queResult->Description="";
        $queResult->Error="数据库查询出错";
        $queResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($queResult));//失败返回相关信息

    }
    $dbcon->close();
    exit(json_encode($queResult));

}
else{//启动的最新问卷
    $sql="select * from counselorquestionnaire.tbl_quepublish WHERE is_enable=1 ORDER BY  publish_id DESC ";
    if($result = mysqli_query($dbcon, $sqltwo))
    {
        $row = $result->fetch_assoc();
        $publish_id=$row['publish_id'];
    }
    else{
        $queResult->Status="failed";
        $queResult->StatusCode=0;
        $queResult->Description="";
        $queResult->Error="没有最新问卷可以启动";
        $queResult->Ret_Data="";
        exit(json_encode($queResult));//失败返回相关信息

    }
    $new="";
    $sqlone='SELECT * FROM counselorquestionnaire.view_publish_selectoritems WHERE publish_id = "'. $publish_id .'"';
    if($result=mysqli_query($dbcon,$sqlone)) {
        $queResult->Status = "success";
        $queResult->StatusCode = 1;
        $queResult->Description = "";
        $queResult->Error = "";
        while ($row = $result->fetch_assoc())//取一行作为关联数组
        {
            if ($new != $row['que_id'])
            {
                $queOne['q_id'] = $row['que_id'];
                $new = $row['que_id'];
                $sqltwo = "select * from counselorquestionnaire.view_published_que WHERE  publish_id='".$publish_id."' and que_id='" . $row['que_id'] . "'";
                if ($resulttwo = mysqli_query($dbcon, $sqltwo)) {

                    $rowtwo = $resulttwo->fetch_assoc();
                    $queOne['content'] = $rowtwo['content'];
                    $queOne['score'] = $rowtwo['scores'];
                    array_push($queResult->Ret_Data, $queOne);// 将该题目的内容分数等，即数组q_one添加入数组$queResult->Ret_Data
                    mysqli_free_result($resulttwo);
                } else {
                    $queResult->Status="failed";
                    $queResult->StatusCode=0;
                    $queResult->Description="";
                    $queResult->Error="数据库查询出错";
                    $queResult->Ret_Data="";
                    $dbcon->close();
                    exit(json_encode($queResult));//失败返回相关信息
                }

            }
            $queSelector['s_id'] = $row['selector_id'];//题目的选项、标识、百分比
            $queSelector['mark'] = $row['selector_mark'];
            $queSelector['percent'] = $row['score_percent'];
            array_push($queResult->Ret_Data[count($queResult->Ret_Data) - 1]['selectors'], $queSelector);//array_push每一题的选项
        }
        mysqli_free_result($result);
    }
    else{
        $queResult->Status="failed";
        $queResult->StatusCode=0;
        $queResult->Description="";
        $queResult->Error="数据库查询出错";
        $queResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($queResult));//失败返回相关信息
    }
    $dbcon->close();
    exit(json_encode($queResult));

}
