<?php

/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 22:36
 */
class requestResponse
{
    public $Status = "";
    public $StatusCode = "";
    public $Description = "";
    public $Error = "";
    public $Ret_Data = "";
}

include_once 'verify.php';
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
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息
}

if (isset($_POST['new_examination']) && !empty($_POST['new_examination'])) {
    include_once 'json_admin.php';
    //事务处理的开始;
    $dbcon->begin_transaction();
    //关闭自动提交事务
    $dbcon->autocommit(false);

    $temp_assoc = json_decode($_POST['new_examination'], true);
    $temp_title = $dbcon->real_escape_string($temp_assoc['Title']);
    $sql_set_title = 'insert into tbl_quetemplate (template_title) values ("'.$temp_title.'")';
    $dbcon->query($sql_set_title);
    $template_id = $dbcon->insert_id;
    foreach ($temp_assoc['Ret_Data'] as $fec_idx1 => $fec_val1) {
        $temp_que_content = $fec_val1['content'];
        $temp_que_score = intval($fec_val1['score']);
        $sql_set_item = 'insert into tbl_queitems (template_id, content, scores) values 
                        ("'.$template_id.'","'.$temp_que_content.'","'.$temp_que_score.'")';
        $dbcon->query($sql_set_item);
        $que_item_id = $dbcon->insert_id;
        $temp_que_selectors = $fec_val1['selectors'];
        foreach ($temp_que_selectors as $fec_idx2 => $fec_val2){
            $sql_set_selector = 'insert into tbl_queselectors (que_id, selector_mark, content, score_percent) VALUES 
                                ("'.$que_item_id.'","'.$fec_val2['mark'].'","'.$fec_val2['content'].'","'.$fec_val2['percent'].'")';
            $dbcon->query($sql_set_selector);
        }
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
        $retResult->Error = "数据库执行出错";
        $retResult->Ret_Data = "";
    }
    $dbcon->close();
} else {
    $retResult->Status = "failed";
    $retResult->StatusCode = 0;
    $retResult->Description = "";
    $retResult->Error = "参数有误";
    $retResult->Ret_Data = "";
}
echo(json_encode($retResult));