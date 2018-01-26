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
