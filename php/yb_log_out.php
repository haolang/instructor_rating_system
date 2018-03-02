<?php
/**
 * Created by PhpStorm.
 * User: Linker
 * Date: 2018/1/27
 * Time: 15:27
 */

include 'php_lib/global_src.php';
session_start();
$_REQUEST_RESPONSE = array();
if(isset($_SESSION['access_token'])){
    $url = "https://openapi.yiban.cn/oauth/revoke_token";
    $postData = array(
        "client_id" => $_G_YB_APP_ID,
        "access_token" => $_SESSION['access_token']
    );//配置应用信息
    $ch = curl_init();
    $opts = array(
        CURLOPT_HEADER => false,
        CURLOPT_POST => true,
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => $postData
    );//配置选项
    curl_setopt_array($ch,$opts);
    $_REQUEST_RESPONSE['data'] = json_decode(curl_exec($ch));
    $_REQUEST_RESPONSE['status'] = 'success';
    $_REQUEST_RESPONSE['status_code'] = '1';
    $_REQUEST_RESPONSE['alertInfo'] = '注销完成';
    // 重置会话中的所有变量
    $_SESSION = array();

// 如果要清理的更彻底，那么同时删除会话 cookie
// 注意：这样不但销毁了会话中的数据，还同时销毁了会话本身
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

// 最后，销毁会话
    session_destroy();
}else{
    $_REQUEST_RESPONSE['data'] = '';
    $_REQUEST_RESPONSE['status'] = 'failed';
    $_REQUEST_RESPONSE['status_code'] = '0';
    $_REQUEST_RESPONSE['error'] = '未登录';
    $_REQUEST_RESPONSE['errorCode'] = '';
    $_REQUEST_RESPONSE['alertInfo'] = '注销失败，未登录';
}
echo json_encode($_REQUEST_RESPONSE);
