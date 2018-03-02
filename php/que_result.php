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
    public $Status = "failed";
    public $StatusCode = "0";
    public $Description="";
    public $Error = "";
    public $Ret_Data="";
}
header('Content-Type:text/json');
$retResult = new requestResponse();//一个返回对象
session_start();
if (!(isset($_SESSION["stu_name"]) &&
    !empty($_SESSION["stu_name"]) &&
    isset($_SESSION["stu_no"]) &&
    !empty($_SESSION["stu_no"]) &&
    isset($_SESSION["stu_ybid"])&&
    !empty($_SESSION["stu_ybid"]))
) {//如果成功
    $retResult->Status = "failed";
    $retResult->StatusCode = 0;
    $retResult->Description = "";
    $retResult->Error = "未登陆";
    exit(json_encode($retResult));
}

if(isset($_POST['user_paper']) && !empty($_POST['user_paper'])){
    $paper_data_json = json_decode($_POST['user_paper'],true);
    if($paper_data_json !== null){
        $s_ybid = $_SESSION["stu_ybid"];
        include_once 'json_student.php';
        $sql_check_done = 'select is_done from tbl_students where student_ybid = '.$s_ybid;
        if($result_check_done = $dbcon->query($sql_check_done)){
            $row_check_done = $result_check_done->fetch_array();
            if($row_check_done[0] == '1'){
                $retResult->Description = "";
                $retResult->Error = "您已经填写过该问卷了";
            }else{
                $sql1 = 'select que_id, selector_mark, selector_id from view_selectors_enabled';
                if($sql1_result = $dbcon->query($sql1)){
                    if($sql1_result != null){
                        $sql1_assoc_rows = array();
                        $sql1_assoc_rows_val = array();
                        while($sql1_row = $sql1_result->fetch_array()){
                            if(!isset($sql1_assoc_rows[$sql1_row[0]])){
                                $sql1_assoc_rows[$sql1_row[0]] = array();
                            }
                            $sql1_assoc_rows[$sql1_row[0]][$sql1_row[1]] = $sql1_row[2];
                        }
                        $valid_flag = false;
                        $que_seq = '';
                        foreach ($paper_data_json as $fec_idx1 => $fec_val1){
                            if(!isset($sql1_assoc_rows[$fec_idx1][$fec_val1])){
                                $valid_flag = true;
                                break;
                            }
                            $que_seq .= $sql1_assoc_rows[$fec_idx1][$fec_val1].';';
                            $sql1_assoc_rows[$fec_idx1] = '';
                        }
                        $que_seq = substr($que_seq,0,-1);
                        if($valid_flag == false && !empty($que_seq) && count($sql1_assoc_rows) == count($paper_data_json)){
                            $sql_save_que = 'call sp_save_que('.$s_ybid.',(select publish_id from tbl_quepublish where is_enable = 1),
                                    "'.$que_seq.'", @sp_result)';
                            $dbcon->query($sql_save_que);
                            if($sql2_result = $dbcon->query('select @sp_result')){
                                $sql2_row =  $sql2_result->fetch_array();
                                if($sql2_row[0] === '1'){
                                    $retResult->Status = "success";
                                    $retResult->StatusCode = 1;
                                    $retResult->Description = "";
                                    $retResult->Error = "";
                                    $retResult->Ret_Data = "";
                                }else{
                                    $retResult->Description = "";
                                    $retResult->Error = "存储过程错误";
                                }
                            }else{
                                $retResult->Description = "";
                                $retResult->Error = $que_seq."数据库错误1".$dbcon->error;
                            }
                        }else{
                            $retResult->Description = "";
                            $retResult->Error = "参数有误，检验未通过";
                        }
                    }else{
                        $retResult->Description = "";
                        $retResult->Error = "没有问卷开启";
                    }
                }else{
                    $retResult->Description = "";
                    $retResult->Error = "数据库错误2".$dbcon->error;
                }
            }
        }else{
            $retResult->Description = "";
            $retResult->Error = "数据库错误3".$dbcon->error;
        }

        $dbcon->close();
    }else{
        $retResult->Description = "";
        $retResult->Error = "json格式有误";
    }
}else{
    $retResult->Description = "";
    $retResult->Error = "参数错误";
}
echo json_encode($retResult);
