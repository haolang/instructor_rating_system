<?php
/**
 * Created by PhpStorm.
 * User: Shinelon
 * Date: 2018/1/23
 * Time: 14:35
 */
include 'php_lib/global_src.php';

preg_match_all('/[^\/]{1,}[^\/]/',$_SERVER['HTTP_REFERER'],$array_tmp);

$http_referer_fname = end($array_tmp[0]);

$url_array_stu = array('index.html');
$url_array_tcr = array('statistic.html','statistic_detail.html');
$url_array_admin = array('admin.html');



if (in_array($http_referer_fname,$url_array_stu)){
    header('location: '.$_G_OAUTH_ADDR);
}elseif (in_array($http_referer_fname,$url_array_tcr)){
    header('location: '.$_G_OAUTH_ADDR);
}elseif (in_array($http_referer_fname,$url_array_admin)){
    header('location: admin_log.html');
}else{
    header('location: '.$_G_OAUTH_ADDR);
}
?>

<?php
/*试着写了一个
class requestResponse {
    public $data = "";
    public $status = "";
    public $statusCode = "";
    public $error = "";
    public $errorCode = "";
    public $alertInfo = "";
}
$retResult = new requestResponse();//一个返回对象
header('Content-type: application/json');
$url=$_SERVER['HTTP_REFERER'];
if(strpos($url,'index.html')||strpos($url,'statistic.html')||strpos($url,'(statistic_detail.php')){
    $code = $_GET['code'];
    $url = "https://openapi.yiban.cn/oauth/access_token?code=$code&client_id=486fc9915ea47e2a&client_secret=64f0734712f4d0d18b2f4259c523f1d0&redirect_uri=http://IP地址/instructor_rating_system/index.html";//授权完成以后调到的地址。client_id和client_secret哪来的
//接受到token
    $token = file_get_contents($url);
    $token_obj = json_decode($token,true);//返回的array数组
    if($token_obj['status']=='error'){//判定请求是否成功
        $retResult->data = $token_obj;
        $retResult->status = 'failed';
        $retResult->error = '请求access_token失败：'.$token_obj['code'].'-'.$token_obj['msgCN'];
        $retResult->statusCode = 0;
        exit(json_encode($retResult));//失败返回相关信息
    }
    $token = $token_obj['access_token'];//保存access_token
    //使用access_token请求用户信息
    $url = "https://openapi.yiban.cn/user/verify_me?access_token=$token";
    $userInfo = file_get_contents($url);
    $userInfo_obj = json_decode($userInfo);//array数组可以->这样查吗
    if($userInfo_obj->status != 'success'){//判定请求是否成功
        $retResult->data = $userInfo_obj;
        $retResult->status = 'failed';
        $retResult->statusCode = 0;
        $retResult->error = '请求用户信息失败：'.$userInfo_obj->info->code.'-'.$userInfo_obj->info->msgCN;
        exit(json_encode($retResult));//失败返回相关信息
    }
    session_start();
    if($userInfo_obj->info->yb_employid=="")//学生登录
    {
        $_SESSION["s_ybid"]=$userInfo_obj->info->yb_userid;//设置易班session，用于学生是否登录的session验证
        $yb_id=$userInfo_obj->info->yb_userid;
        $_SESSION["s_stuid"]=$userInfo_obj->info->yb_studentid;//
        $stu_num=$userInfo_obj->info->yb_studentid;
        $_SESSION["s_name"]=$userInfo_obj->info->yb_realname;
        include_once'json_student.php';
        $sql="select fun_is_complish('".$yb_id."')";
        if(mysqli_query($dbcon ,$sql))//返回值为1？学生已完成问卷
        {

            $retResult->data = "";
            $retResult->status = 'failed';
            $retResult->statusCode = 0;
            $retResult->error ='问卷已填写完毕了';
            exit(json_encode($retResult));//失败返回相关信息

        }
        else{//学生未完成试卷
            $url = "http://202.115.195.224/api/get_stuinfo.php?studentid='".$stu_num."'&valid_c=test_api_pass";
            $token = file_get_contents($url);
            $token_obj = json_decode($token,true);//返回的array数组
            if($token_obj->status=='success'&&$token_obj->ret_Data->table!="")//要求table不为空
            {
                $stu_name=$token_obj->ret_Data->table->xm;
                $stu_depart=$token_obj->ret_Data->table->xy;
                $stu_pro=$token_obj->ret_Data->table->zy;
                $stu_grade=$token_obj->ret_Data->table->nj;
                $stu_class=$token_obj->ret_Data->table->bj;
                $stu_depart_num=$token_obj->ret_Data->table->xydm;
                $stu_pro_num=$token_obj->ret_Data->table->zydm;
                $stu_class_num=$token_obj->ret_Data->table->bjdm;
                include_once'json_student.php';
                $sql="select fun_update_stuinfo('".$yb_id."','". $stu_num."','". $stu_name."','".  $stu_depart."','". $stu_pro."',
                '".$stu_grade."', '".$stu_class."','".$stu_depart_num."','".$stu_pro_num."','".$stu_class_num."')";
                if(mysqli_query($dbcon ,$sql))
                {

                    $retResult->data = "";
                    $retResult->status = 'failed';
                    $retResult->statusCode = 0;
                    $retResult->error ='存储更新学生信息成功';
                    exit(json_encode($retResult));

                }

            }
            else{
                $retResult->data = "";
                $retResult->status = 'failed';
                $retResult->statusCode = 0;
                $retResult->error ='教务处无该学生学号';
                exit(json_encode($retResult));//失败返回相关信息

            }
            $retResult->data = "";
            $retResult->status = 'failed';
            $retResult->statusCode = 0;
            $retResult->error ='';
            exit(json_encode($retResult));//失败返回相关信息
        }

    }
    // 应该在学生填写页面不存在登录教师账号
     // else{
     //      $_SESSION["t_ybid"]=$userInfo_obj->info->yb_userid;//设置易班session，用于老师是否登录的session验证
      //     $_SESSION["t_name"]=$userInfo_obj->info->yb_employid;
     //  }



}
else if(strpos($url,'admin.php')){
    header('Location: admin_log.php');
}*/
