<?php
/**
 * Created by PhpStorm.
 * User: Linker
 * Date: 2018/3/6
 * Time: 14:23
 */
function getIP() /*获取客户端IP*/
{
    if (@$_SERVER["HTTP_X_FORWARDED_FOR"])
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    else if (@$_SERVER["HTTP_CLIENT_IP"])
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    else if (@$_SERVER["REMOTE_ADDR"])
        $ip = $_SERVER["REMOTE_ADDR"];
    else if (@getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (@getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (@getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else
        $ip = "Unknown";
    return $ip;
}

function setLogToDB($dbcon,$op_des,$operator){
    $log_sql = 'INSERT INTO tbl_opearte_log (operate_description,operator,operate_ipaddr) 
                VALUES ("'.$op_des.'","'.$operator.'","'.getIP().'")';
    $dbcon->query($log_sql);
}