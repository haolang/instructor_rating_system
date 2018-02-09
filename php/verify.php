<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/2/8
 * Time: 20:55
 */
function data_validation($check_str,$mode)
{
    //检查参数输入格式是否正确，不正确返回‘-1’
    if(gettype($check_str) !== "string"||gettype($mode) !== "string")
    {
        return '{"mode":"'.$mode.'","statusCode":"-1","error":"函数输入实参数据类型错误！"}';
    }

    $mode_re_array = array(
        "Number"=>'/^[0-9]+$/',    //纯数字
        "Realnumber"=>'/^(\-|\+)?\d+(\.\d+)?$/ '

    );
    if(!array_key_exists($mode,$mode_re_array))

    {
        return '{"mode":"'.$mode.'","statusCode":"-1","error":"无'.$mode.'匹配模式！"}';
    }
    if(preg_match($mode_re_array[$mode],$check_str))
    {
        return 1;
    }
    else
    {
        return  '{"mode":"'.$mode.'","statusCode":"0","error":"字符串模式不匹配！"}';
    }
}
