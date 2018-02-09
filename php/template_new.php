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
include_once'verify.php';
$retResult = new requestResponse();//一个返回对象
if(!empty($_POST['new_examination'])) {
    mysqli_query($dbcon,'BEGIN') ;//或者事务处理的开始;
    header('Access-Control-Allow-Origin:*');//注意！跨域要加这个头 上面那个没有
    $student =  mysqli_real_escape_string($dbcon,$_POST['new_examination']);
    $template_name = $student['Title'];
    $t = date('Y-m-d H:i:s');
    $sql = 'insert into tbl_quetemplate (template_title,c_time)
    VALUES (\'' . $template_name . '\',\'' . $t . '\')';//  插入到表tbl_quetemplate中
    if (mysqli_query($dbcon, $sql)) {
        $sql = "select * from tbl_quetemplate  ORDER BY template_id DESC ";
        if ($result = mysqli_query($dbcon, $sql)) {
            $row = $result->fetch_assoc();
            $template_id = $row['template_id'];//获取得到template_id
            $questions = $student['Ret_Data'];
            for ($i = 0; $i < sizeof($questions); $i++) {
                $details = $questions[$i];

                $content = $details['content'];
                $que_score = $details['score'];
                if(data_validation($que_score,'Number')!=1)//检验是否为纯数字
                {
                    mysqli_query($dbcon,"ROLLBACK");//事务回滚
                    mysqli_query($dbcon,"END");//结束
                    $retResult->Status= "failed";
                    $retResult->StatusCode = 0;
                    $retResult->Description="";
                    $retResult->Error="分数不为数字";
                    $retResult->Ret_Data="";
                    $dbcon->close();
                    exit(json_encode($retResult));//失败返回相关信息


                }
                $sql = 'insert into tbl_queitems (template_id,content,scores)
                VALUES (\'' . $template_id . '\',\'' . $content . '\',\'' . $que_score . '\')';//  插入que_id自增
                if ($result = mysqli_query($dbcon, $sql)) {
                    $sql = "select * from tbl_queitems ORDER BY que_id DESC ";
                    if ($result = mysqli_query($dbcon, $sql)) {
                        $row = $result->fetch_assoc();
                        $que_id = $row['que_id'];//获取得到que_id
                        $selectors = $details['selectors'];
                        $mark = $selectors['mark'];
                        $selector_content = $selectors['content'];
                        $selector_percent = $selectors['percent'];
                        if(data_validation( $selector_percent,' "Realnumber"')!=1)//检验是否为纯数字
                        {
                            mysqli_query($dbcon,"ROLLBACK");//事务回滚
                            mysqli_query($dbcon,"END");//结束
                            $retResult->Status= "failed";
                            $retResult->StatusCode = 0;
                            $retResult->Description="";
                            $retResult->Error="百分比不为实数";
                            $retResult->Ret_Data="";
                            $dbcon->close();
                            exit(json_encode($retResult));//失败返回相关信息


                        }
                        for ($i = 0; $i < sizeof($selectors); $i++) {
                            $seletor_detail = $selectors[$i];
                            $sql = 'insert into tbl_queselectors (que_id,selector_mark,content,score_percent)
                           VALUES (\'' . $que_id . '\',\'' . $mark . '\',\'' . $selector_content . '\',\'' . $selector_percent . '\')';//  插入que_id自增
                            if ($result = mysqli_query($dbcon, $sql)) {
                                continue;
                            } else {
                                mysqli_query($dbcon,"ROLLBACK");//事务回滚
                                mysqli_query($dbcon,"END");//结束
                                $retResult->Status= "failed";
                                $retResult->StatusCode = 0;
                                $retResult->Description="";
                                $retResult->Error="选项插入失败";
                                $retResult->Ret_Data="";
                                $dbcon->close();
                                exit(json_encode($retResult));//失败返回相关信息
                            }


                        }

                    } else {
                        mysqli_query($dbcon,"ROLLBACK");//事务回滚
                        mysqli_query($dbcon,"END");//结束
                        $retResult->Status= "failed";
                        $retResult->StatusCode = 0;
                        $retResult->Description="";
                        $retResult->Error="获取得到q_id失败";
                        $retResult->Ret_Data="";
                        $dbcon->close();
                        exit(json_encode($retResult));//失败返回相关信息
                    }
                } else {
                    mysqli_query($dbcon,"ROLLBACK");//事务回滚
                    mysqli_query($dbcon,"END");//结束
                    $retResult->Status= "failed";
                    $retResult->StatusCode = 0;
                    $retResult->Description="";
                    $retResult->Error="插入新模板失败";
                    $retResult->Ret_Data="";
                    $dbcon->close();
                    exit(json_encode($retResult));//失败返回相关信息
                }


            }
            mysqli_query($dbcon,"COMMIT");//事务处理的提交。
            mysqli_query($dbcon,"END");//结束
            $retResult->Status= "success";
            $retResult->StatusCode = 1;
            $retResult->Description="";
            $retResult->Error="";
            $retResult->Ret_Data="";
            $dbcon->close();
            exit(json_encode($retResult));
        } else {
            mysqli_query($dbcon,"ROLLBACK");//数据回滚
            mysqli_query($dbcon,"END");//结束
            $retResult->Status= "failed";
            $retResult->StatusCode = 0;
            $retResult->Description="";
            $retResult->Error="获取得到template_id失败";
            $retResult->Ret_Data="";
            $dbcon->close();
            exit(json_encode($retResult));//失败返回相关信息
        }
    }
    else{
        mysqli_query($dbcon,"ROLLBACK");//数据回滚
        mysqli_query($dbcon,"END");//结束
        $retResult->Status= "failed";
        $retResult->StatusCode = 0;
        $retResult->Description="";
        $retResult->Error="插入到表tbl_quetemplate失败";
        $retResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($retResult));//失败返回相关信息

    }
}
else
{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="$_POST[new_examination]为空";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息

}

