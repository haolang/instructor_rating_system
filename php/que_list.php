<?php
/**
 * Created by PhpStorm.
 * User: Shinelon
 * Date: 2018/1/23
 * Time: 14:35
 */
header('Context-Type:text/json;charset=UTF-8');
header('Access-Control-Allow-Origin:*');  //用于测试时可跨域请求  上线后需要删除


echo '{
    "Status":"success",
    "StatusCode":1,
    "Description":"",
    "Error":"",
    "Ret_Data":[
        {
            "q_id":1,
            "content":"将数据存储于数据库。",
            "score":10,
            "selectors":[
                {
                    "s_id":1,
                    "mark":"A",
                    "content":"好",
                    "percent":95
                },
                {
                    "s_id":2,
                    "mark":"B",
                    "content":"一般",
                    "percent":80
                }
            ]
        },
        {
            "q_id":2,
            "content":"将数据存储库。",
            "score":10,
            "selectors":[
                {
                    "s_id":1,
                    "mark":"A",
                    "content":"好",
                    "percent":95
                },
                {
                    "s_id":2,
                    "mark":"B",
                    "content":"一般",
                    "percent":80
                }
            ]
        }
    ]
}'
;