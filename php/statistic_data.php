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

$retResult = new requestResponse();//一个返回对象
$start=$_GET['p_start'];//开始页码
$limit=$_GET['p_limit'];
$paper_id=$_GET['paper_id'];//问卷id
if(!preg_match('/[0-9]+/',$start.$limit.$paper_id))
{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="参数错误";
    $retResult->Ret_Data="";
    exit(json_encode($retResult));//失败返回相关信息
}


session_start();
if (isset($_SESSION["t_ybid"]) && !empty($_SESSION["t_ybid"]) &&
    isset($_SESSION["t_name"])&&!empty($_SESSION["t_name"]) &&
    isset($_SESSION["t_no"])&&!empty($_SESSION["t_no"]) &&
    isset($_SESSION["t_identify"])&&!empty($_SESSION["t_identify"])
) {
    include_once'json_teacher.php';
    $ybid = $_SESSION["t_ybid"];
    $identify = $_SESSION["t_identify"];
    if($identify == 1){
        //辅导员
        $sql = 'select * from view_result_score_name where teacher_ybid = '.$ybid;
    }elseif ($identify == 2){
        //学院副书记
        $sql = 'select * from view_result_score_name WHERE in_dep = 
                (SELECT in_dep FROM tbl_infochecker where checker_ybid = '.$ybid.')';
    }else{
        //学工部
        $sql = 'select * from view_result_score_name where 1';
    }
    if($_GET['dep'] != '0'){
        $dep = $dbcon->real_escape_string($_GET['dep']);
        $sql .= ' and in_dep = "'.$dep.'"';
    }
    if($paper_id == '0'){
        $sql .= ' and que_publish_id = (select max(que_publish_id) from view_result_score_name)';
    }else{
        $sql .= ' and que_publish_id = '.$paper_id;
    }
    if(!empty($_GET['name_keyword'])){
        $name_keyword = $dbcon->real_escape_string($_GET['name_keyword']);
        $sql .= ' and checker_name like "%'.$name_keyword.'%"';
    }
    $sql .= ' limit '.$start.','.$limit;
    if($sql_result = $dbcon->query($sql)){
        while ($sql_row = $sql_result->fetch_assoc()){
            $detail['teacher_id']=$sql_row['teacher_ybid'];
            $detail['paper_id']=$sql_row['que_publish_id'];
            $detail['t_name']=$sql_row['checker_name'];
            $detail['t_dep']=$sql_row['in_dep'];
            $detail['t_dep_comment']="";
            $detail['t_dep_average']=$sql_row['t_ave_score'];
            $detail['done_num']=$sql_row['done_num'];
            $detail['all_num']=$sql_row['needed_num'];
            $detail['done_percent']=$sql_row['involve_percent'];
            $detail['good_percent']=$sql_row['good_per'];
            $detail['bad_percent']=$sql_row['bad_per'];
            $detail['distribution_A']=$sql_row['number_distribution1'];//选a的人数
            $detail['distribution_B']=$sql_row['number_distribution2'];//选b的人数
            $detail['distribution_C']=$sql_row['number_distribution3'];//选c的人数
            $detail['distribution_D']=$sql_row['number_distribution4'];//选d的人数
            array_push($retResult->Ret_Data,$detail);
        }
        $retResult->Status = "success";
        $retResult->StatusCode = 1;
        $retResult->Description = "";
    }else{
        $retResult->Status = "failed";
        $retResult->StatusCode = 0;
        $retResult->Description = "";
        $retResult->Error = "数据库错误".$dbcon->error;
        $retResult->Ret_Data = "";
    }
    $dbcon->close();
} else {
    $retResult->Status = "failed";
    $retResult->StatusCode = 0;
    $retResult->Description = "";
    $retResult->Error = "管理员未登录";
    $retResult->Ret_Data = "";
}
echo json_encode($retResult);
