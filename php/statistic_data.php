<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 12:17
 */
class requestResponse {
    public $Status = "";
    public $StatusCode = "";
    public $Description="";
    public $Error = "";
    public $Ret_Data=array(

    );
}

/*用于测试
public $Ret_Data=array(
    array (
        'teacher_id'=>'1',
        't_name'=>'余建鹏',
        "t_dep"=>'计算机科学学院',
        't_dep_comment'=>'',
        "t_dep_average"=>"87",
        "done_num"=>242,
        "all_num"=>244,
        "done_percent"=>91.23,
        "good_percent"=>88.1,
        "bad_percent"=>3.1,
        "distribution_A"=>73.5,
        "distribution_B"=>73.5,
        'distribution_C'=>73.5,
        'distribution_D'=>73.5
    )


);*/
include_once'json_teacher.php';
$retResult = new requestResponse();//一个返回对象
$start=$_GET['p_start'];//开始页码
if($start<0)
{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="参数(开始页码)<0";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息

}
$limit=$_GET['limit'];
$id=$_GET['que_id'];//问卷id
$detail=array(
    'teacher_id'=>'',
    't_name'=>'',
    "t_dep"=>'',
    't_dep_comment'=>'',
    "t_dep_average"=>"",
    "done_num"=>'',
    "all_num"=>'',
    "done_percent"=>'',
    "good_percent"=>'',
    "bad_percent"=>'',
    "distribution_A"=>'',
    "distribution_B"=>'',
    'distribution_C'=>'',
    'distribution_D'=>''
);
$identify="";
if(!empty($start)&&!empty($limit)&&!empty($id)) {//开始页码和页长度有什么作用
//通过易班id查询身份返回结果集$_SESSION['t_ybid']
//调用函数传参（开始页码，长度，问卷id）,返回结果集 遍历结果集
    $identify = '';
    $admin_ybid=$_SESSION['t_ybid'];//不可能出现session为空的情况
    $sql='SELECT * FROM tbl_infochecker WHERE checker_ybid = "'. $admin_ybid .'"';//利用教师yb_id来查找其身份
    if($result=mysqli_query($dbcon,$sql))
    {
        if($row=$result->fetch_assoc())//取一行作为关联数组
        {
            if($row['identify']=='1')//身份为辅导员
            {
                $worknum=$row['worker_no'];//工号
                $sql='SELECT * FROM view_result_score_name WHERE que_publish_id= "'. $id .'" and worker_no="'.$worknum.'" ';
                if($result=mysqli_query($dbcon,$sql))
                {
                    $queResult->Status= "success";
                    $queResult->StatusCode = 1;
                    $queResult->Description="";
                    $queResult->Error="";
                    $row=$result->fetch_assoc(); //teacher_id为结果序号？
                    $detail['teacher_id']=1;
                    $detail['t_name']=$row['checker_name'];
                    $detail['t_dep']=$row['in_dep'];
                    $detail['t_dep_comment']="";
                    $detail['t_dep_average']=$row['t_ave_score'];
                    $detail['done_num']=$row['done_num'];
                    $detail['all_num']=$row['needed_num'];
                    $detail['done_percent']=$row['involve_percent'];
                    $detail['good_percent']=$row['good_per'];
                    $detail['bad_percent']=$row['bad_per'];
                    $detail['distribution_A']=$row['number_distribution1'];//选a的人数
                    $detail['distribution_B']=$row['number_distribution2'];//选b的人数
                    $detail['distribution_C']=$row['number_distribution3'];//选c的人数
                    $detail['distribution_D']=$row['number_distribution4'];//选d的人数
                    array_push( $retResult->Ret_Data,$detail);// 将该题目的内容分数等，即数组q_one添加入数组$queResult->Ret_Data
                    mysqli_free_result($result);
                    exit(json_encode($retResult));

                }
                else{
                    $retResult->Status= "failed";
                    $retResult->StatusCode = 0;
                    $retResult->Description="";
                    $retResult->Error="fail in choose fudaoyuan's information by SQL";
                    $retResult->Ret_Data="";
                    $dbcon->close();
                    exit(json_encode($retResult));//失败返回相关信息

                }

            }
            else if($row['identify']=='2')//身份为学院副书记(可以查看本学院所有辅导员评价结果)
            {
                $department=$row['in_dep'];
                $sql='SELECT * FROM view_result_score_name WHERE que_publish_id= "'. $id .'" and in_dep="'.$department.'" ';
                if($result=mysqli_query($dbcon,$sql))
                {
                    $queResult->Status= "success";
                    $queResult->StatusCode = 1;
                    $queResult->Description="";
                    $queResult->Error="";
                    $detailnum=0;
                    while($row=$result->fetch_assoc())
                        //teacher_id为结果序号？
                    {
                        $detailnum++;
                        $detail['teacher_id']=$detailnum;
                        $detail['t_name']=$row['checker_name'];
                        $detail['t_dep']=$row['in_dep'];
                        $detail['t_dep_comment']="";
                        $detail['t_dep_average']=$row['t_ave_score'];
                        $detail['done_num']=$row['done_num'];
                        $detail['all_num']=$row['needed_num'];
                        $detail['done_percent']=$row['involve_percent'];
                        $detail['good_percent']=$row['good_per'];
                        $detail['bad_percent']=$row['bad_per'];
                        $detail['distribution_A']=$row['number_distribution1'];//80-90的人数
                        $detail['distribution_B']=$row['number_distribution2'];//70-80的人数
                        $detail['distribution_C']=$row['number_distribution3'];//...
                        $detail['distribution_D']=$row['number_distribution4'];//..
                        array_push( $retResult->Ret_Data,$detail);// 将该题目的内容分数等，即数组q_one添加入数组$queResult->Ret_Data

                    }
                    mysqli_free_result($result);
                    $dbcon->close();
                    exit(json_encode($retResult));


                }
                else{
                    $retResult->Status= "failed";
                    $retResult->StatusCode = 0;
                    $retResult->Description="";
                    $retResult->Error="fail in choose department's information by SQL";
                    $retResult->Ret_Data="";
                    $dbcon->close();
                    exit(json_encode($retResult));//失败返回相关信息

                }
            }

        }
        else if($row['identify']=='3')//学工部全部
        {
            $sql='SELECT * FROM view_result_score_name WHERE que_publish_id= "'. $id .'"  ';
            if($result=mysqli_query($dbcon,$sql))
            {
                $queResult->Status= "success";
                $queResult->StatusCode = 1;
                $queResult->Description="";
                $queResult->Error="";
                $detailnum=0;
                while($row=$result->fetch_assoc())
                    //teacher_id为结果序号？
                {
                    $detailnum++;
                    $detail['teacher_id']=$detailnum;
                    $detail['t_name']=$row['checker_name'];
                    $detail['t_dep']=$row['in_dep'];
                    $detail['t_dep_comment']="";
                    $detail['t_dep_average']=$row['t_ave_score'];
                    $detail['done_num']=$row['done_num'];
                    $detail['all_num']=$row['needed_num'];
                    $detail['done_percent']=$row['involve_percent'];
                    $detail['good_percent']=$row['good_per'];
                    $detail['bad_percent']=$row['bad_per'];
                    $detail['distribution_A']=$row['number_distribution1'];//选a的人数
                    $detail['distribution_B']=$row['number_distribution2'];//选b的人数
                    $detail['distribution_C']=$row['number_distribution3'];//选c的人数
                    $detail['distribution_D']=$row['number_distribution4'];//选d的人数
                    array_push( $retResult->Ret_Data,$detail);// 将该题目的内容分数等，即数组q_one添加入数组$queResult->Ret_Data

                }
                mysqli_free_result($result);
                $dbcon->close();
                exit(json_encode($retResult));


            }
            else{
                $retResult->Status= "failed";
                $retResult->StatusCode = 0;
                $retResult->Description="";
                $retResult->Error="fail in choose all information by SQL";
                $retResult->Ret_Data="";
                $dbcon->close();
                exit(json_encode($retResult));//失败返回相关信息

            }

        }
    }
    else
    {
        $retResult->Status= "failed";
        $retResult->StatusCode = 0;
        $retResult->Description="";
        $retResult->Error="fail in finding the identify of the admin by SQL";
        $retResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($retResult));//失败返回相关信息

    }

}
else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="参数缺失parameter lose";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息
}


