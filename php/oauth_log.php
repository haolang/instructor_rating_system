<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/19
 * Time: 22:17
 */
/*
 * 判断页面的来源
 */
$url=$_SERVER['HTTP_REFERER'];
if(strpos($url,'index.html')){
    header('Location: https://www.yiban.cn/login?go=http://app.yiban.cn');//登录页是这个吗
}
else if(strpos($url,'statistic.html')||strpos($url,'(statistic_detail.php')||strpos($url,'admin.php')){
    header('Location: admin_log.php');
}