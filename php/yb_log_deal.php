<?php
/**
 * Created by PhpStorm.
 * User: Linker
 * Date: 2017/12/28
 * Time: 20:04
 */

include_once 'php_lib/db_con_test.php';
session_set_cookie_params(3600 * 2);
session_start();
$ch = curl_init();
$opts = array(
    CURLOPT_HEADER => false,
    CURLOPT_POST => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
);//配置选项
curl_setopt_array($ch,$opts);
if(isset($_GET['code'])){
    //接受到code并请求一个token
    $code = $_GET['code'];
    $url = "https://oauth.yiban.cn/token/info?code=$code&client_id=$_G_YB_APP_ID&client_secret=$_G_YB_APP_SECRET&redirect_uri=$_G_REDIRECT_URI";
    //接受到token
    curl_setopt($ch,CURLOPT_URL,$url);

    $token = curl_exec($ch);

    $token_obj = json_decode($token);

    if(isset($token_obj->code)){//判定请求是否成功
        curl_close($ch);
        $ret_data_struct["ret_data"] = $token_obj;
        $ret_data_struct["status"] = 'failed';
        $ret_data_struct["status_code"] = '0';
        $ret_data_struct["error"] = '请求access_token失败：'.$token_obj->code.'-'.$token_obj->msgCN;
        $db_con->close();
        exit(json_encode($ret_data_struct));//失败返回相关信息
    }
}
$token = $token_obj->access_token;//保存access_token
//使用access_token请求用户信息
$url = "https://openapi.yiban.cn/user/me?access_token=$token";

curl_setopt($ch,CURLOPT_URL,$url);
$userInfo = curl_exec($ch);

$userInfo_obj = json_decode($userInfo);
if($userInfo_obj->status != 'success'){//判定请求是否成功
    $ret_data_struct["ret_data"] = $userInfo_obj;
    $ret_data_struct["status"] = 'failed';
    $ret_data_struct["statusCode"] = 0;
    $ret_data_struct["error"] = '请求用户信息失败：'.$userInfo_obj->info->code.'-'.$userInfo_obj->info->msgCN;
    $db_con->close();
    exit(json_encode($ret_data_struct));//失败返回相关信息
}

curl_close($ch);

//将用户数据存储或更新
if($db_result = mysql_sql_exec($db_con,'select fun_save_update_users("'.$token_obj->userid.'","'.$userInfo_obj->info->yb_username.'","'.$userInfo_obj->info->yb_userhead.'")')){

}else{
    $ret_data_struct["data"] = "";
    $ret_data_struct["status"] = 'failed';
    $ret_data_struct["statusCode"] = 0;
    $ret_data_struct["error"] = $_ERROR_INFO_TEXT['data_base']['sql_query_error'];
    $db_con->close();
    exit(json_encode($ret_data_struct));
}
$_SESSION['token'] = $token_obj->access_token;
$_SESSION['ybid'] = $token_obj->userid;
$_SESSION['user_name'] = $userInfo_obj->info->yb_username;
$_SESSION['avatar'] = $userInfo_obj->info->yb_userhead;

$db_con->close();

//var_dump($_SESSION);
header("location: index.php");