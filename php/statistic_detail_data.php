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
include_once'json_admin.php';
$retResult = new requestResponse();//一个返回对象
$detail=array(
    'que_content'=>'',
    'all_num'=>'',
  /*  'distribution1_num'=>'',因为选项的数量不确定，动态添加
    'distribution2_num'=>'',
    'distribution3_num'=>'',
    'distribution4_num'=>''*/

);
$que_id=$_GET['que_id'];
$t_id=$_GET['t_id'];
if(!empty($que_id)&&!empty($t_id))
{
    $retResult->Status = "success";//注意这里
    $retResult->StatusCode = 1;
    $retResult->Description="";
    $retResult->Error = "";
    $sql='SELECT * FROM view_detail_data WHERE que_publish_id= "'. $que_id .'" and teacher_ybid="'.$t_id.'"  ';
    if($result=mysqli_query($dbcon,$sql))
    {
        while($row=$result->fetch_assoc())
        {
            $detail['que_content']=$row['content'];
            $detail['all_num']=$row['done_num'];//不清楚是需要的数量还是，已经完成的数量
            $select_result=$row['selector_dis'];//注意选项的个数是不确定的
            $select=explode(';',$select_result);//用分号分割每一个选项和百分比
            for($index=0;$index<count($select);$index++)
            {
                $selectnum=explode(',',$select[$index]);
                $name='distribution'.($index+1).'_num';
                $detail[$name]=$selectnum[0];
            }
            array_push($retResult->Ret_Data, $detail);
        }

        mysqli_free_result($result);

    }
    else{
        $retResult->Status = "failed";//注意这里
        $retResult->StatusCode = 0;
        $retResult->Description="";
        $retResult->Error = "sql view_detail_data 语句执行错误";
        $retResult->Ret_Data="";
        $dbcon->close();
        exit(json_encode($retResult));

    }

}
else{
    $retResult->Status = "failed";//注意这里
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error = "stastic_detail_data.php请求参数缺少parameter lose";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));

}



