<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 14:49
 */
class requestResponse {
    public $Status = "";
    public $StatusCode = "";
    public $Description="";
    public $Error = "";
    public $Ret_Data=array(

    );
}
$retResult = new requestResponse();
if(isset($_GET['Que_id']) && isset($_GET['T_id']) &&
!empty($_GET['Que_id']) && !empty($_GET['T_id'])){
    $paper_id = $_GET['Que_id'];
    $t_id = $_GET['T_id'];
    if(preg_match('/[0-9]+/',$paper_id.$t_id)){
        session_start();
        if (isset($_SESSION["t_ybid"]) && !empty($_SESSION["t_ybid"]) &&
            isset($_SESSION["t_name"])&&!empty($_SESSION["t_name"]) &&
            isset($_SESSION["t_no"])&&!empty($_SESSION["t_no"]) &&
            isset($_SESSION["t_identify"])&&!empty($_SESSION["t_identify"])
        ) {
            $ybid = $_SESSION["t_ybid"];
            $identify = $_SESSION["t_identify"];
            if($identify == 1){
                //辅导员
                $sql = 'select * from view_detail_data where teacher_ybid = '.$ybid;
            }elseif ($identify == 2){
                //学院副书记
                $sql = 'select * from view_detail_data WHERE teacher_ybid in 
                (SELECT checker_ybid FROM tbl_infochecker where in_depno = 
                (SELECT in_depno FROM tbl_infochecker WHERE checker_ybid = '.$ybid.'))';
            }else{
                //学工部
                $sql = 'select * from view_detail_data where 1';
            }
            $sql .= ' and Que_publish_id = '.$paper_id.' and teacher_ybid = '.$t_id;
            include_once 'json_teacher.php';

            if($sql_result = $dbcon->query($sql)){
                $retResult->Status= "success";
                $retResult->StatusCode = 1;
                $retResult->Description=$sql;
                $retResult->Error="";
                while ($sql_row = $sql_result->fetch_assoc()){
                    array_push($retResult->Ret_Data, $sql_row);
                }
            }else{
                $retResult->Status= "failed";
                $retResult->StatusCode = 0;
                $retResult->Description="";
                $retResult->Error="数据库错误".$dbcon->error;
                $retResult->Ret_Data="";
            }
            $dbcon->close();
        }else{
            $retResult->Status = "failed";
            $retResult->StatusCode = 0;
            $retResult->Description = "";
            $retResult->Error = "管理员未登录";
            $retResult->Ret_Data = "";
        }
    }else{
        $retResult->Status= "failed";
        $retResult->StatusCode = 0;
        $retResult->Description="";
        $retResult->Error="参数不符合要求";
        $retResult->Ret_Data="";
    }
}else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="缺少参数";
    $retResult->Ret_Data="";
}
echo(json_encode($retResult));
