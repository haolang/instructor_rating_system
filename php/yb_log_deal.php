<?php
/**
 * Created by PhpStorm.
 * User: Linker
 * Date: 2017/12/28
 * Time: 20:04
 */

/**
 * 包含SDK
 */
require("classes/yb-globals.inc.php");
//配置文件
require_once 'php_lib/global_src.php';

//初始化
$api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
$au  = $api->getAuthorize();

//网站接入获取access_token，未授权则跳转至授权页面
$info = $au->getToken();
if(!$info['status']) {//授权失败
    echo $info['msg'];
    die;
}
$token = $info['token'];//网站接入获取的token

//var_dump($info);
$api->bind($token);
$userInfo_array = $api->request('user/verify_me');

if($userInfo_array['status'] == 'success'){
    $info_array = $userInfo_array['info'];
    //判断是学生还是教师
    if($info_array['yb_employid'] != '' || $info_array['yb_userid'] == '6930829'){
        //$test_val = 1;
        //教师
        include 'php_lib/db_con_test.php';
        $sql = 'select checker_name, worker_no, identify from tbl_infochecker where checker_ybid = '.$info_array['yb_userid'];
        //$sql = 'select checker_name, worker_no, identify from tbl_infochecker where checker_ybid = '.$test_val;
        if($db_result = $db_con->query($sql)){
            $row = $db_result->fetch_array();
            if($row != null){
                session_start();
                $_SESSION['t_ybid']     = $info_array['yb_userid'];
                $_SESSION['t_name']     = $row[0];
                $_SESSION['t_no']       = $row[1];
                $_SESSION['t_identify'] = $row[2];
                $_SESSION['access_token'] = $token;
                //处理完成，重定向至首页
                header("location: ".$_G_APP_ROOT."statistic.html");
            }else{
                echo '您不是辅导员';
            }
            $db_con->close();
        }else{
            $db_con->close();
            die('database error '.$db_con->error);
        }

    }else{
        //学生
        //根据学号从教务处接口获取学籍信息
        $url = 'http://202.115.195.224/api/get_stuinfo.php?studentid='.$info_array['yb_studentid'].'&valid_c=test_api_pass';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $curl_result = curl_exec($ch);
        if($curl_result == false) {
            die(curl_error($ch));
        }
        curl_close($ch);
        $api_result = json_decode($curl_result,true);
        //判断处理是否成功
        if($api_result['status'] == 'success'){
            $api_info_array = $api_result['ret_Data']['table'][0];

            //将请求得到的信息保存到数据库
            include 'php_lib/db_con_test.php';
            $sql = 'select fun_update_stuinfo(
                    "'.$info_array['yb_userid'].'",
                    "'.$info_array['yb_studentid'].'",
                    "'.$api_info_array['xm'].'",
                    "'.$api_info_array['xy'].'",
                    "'.$api_info_array['zy'].'",
                    "'.$api_info_array['nj'].'",
                    "'.$api_info_array['bj'].'",
                    "'.$api_info_array['xydm'].'",
                    "'.$api_info_array['zydm'].'",
                    "'.$api_info_array['bjdm'].'"
                    )';
            $db_con->query($sql);
            $db_con->close();
            //将有关信息保存至session
            session_start();
            $_SESSION['stu_name']   = $api_info_array['xm'];
            $_SESSION['stu_no']     = $info_array['yb_studentid'];
            $_SESSION['stu_ybid']   = $info_array['yb_userid'];
            $_SESSION['access_token'] = $token;
            //处理完成，重定向至首页
            header("location: ".$_G_APP_ROOT."index.html");
        }else{
            die('教务处接口请求处理失败');
        }
        //test todo
        /*session_start();
        $_SESSION['stu_name']   = '况俊豪';//$api_info_array['xm'];
        $_SESSION['stu_no']     = '2015110117';//$info_array['yb_studentid'];
        $_SESSION['stu_ybid']   = '7006795';//$info_array['yb_userid'];
        $_SESSION['access_token'] = $token;*/
        //处理完成，重定向至首页
        header("location: ".$_G_APP_ROOT."index.html");
    }
}else{
    die('易班接口请求处理失败');
}
