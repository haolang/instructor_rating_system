<?php
/**
 * Created by PhpStorm.
 * User: Shinelon
 * Date: 2018/1/23
 * Time: 14:19
 */

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Title</title>
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="jslib/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="jslib/jquery/jquery-3.2.1.min.js"></script>

    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
<!--    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>-->

    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="jslib/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <style>
        /*自定义弹出提示框*/
        .alert_box {
            position: absolute;
            background: #f2eb0e;
            color: red;
            border: 2px solid #fffa6e;
            z-index: 99;
            margin: auto;
            padding: 3px;
            width: auto;
            height: auto;
            border-radius: 4px;
            top: 30px;
            left: 0;
        }

        .alert_box:after, .alert_box:before {
            bottom: 100%;
            left: 20%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .alert_box:after {
            /*border-color: rgba(149, 216, 242, 0);*/
            border-bottom-color: #f2eb0e;
            border-width: 10px;
            margin-left: -10px;
        }

        .alert_box:before {
            /*border-color: rgba(53, 179, 228, 0);*/
            border-bottom-color: #f2eb0e;
            border-width: 13px;
            margin-left: -13px;
        }
        /*自定义弹出提示框------*/

        .template_list p
        {
            margin: 0;
            padding:0;
        }



        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        #examination .questions .que-select
        {
            /*margin-bottom: 3px;*/
            margin-top: 5px;
        }
        #examination .examination-title
        {
            margin: 5px 0 25px 0;
        }
        .input-mid-span,.input-mid-span input
        {

            border-radius: 0 !important;
        }
        .q_id , .mark
        {
            font-size: 20px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="top-container">
                <h1 style="text-align: center">新建模板/试题</h1>
            </div>
        </div>
        <div class="col-md-2 column">
            <div class="left-container">
                <div class="list-group template_list">
<!--                    <a href="#" class="list-group-item list-group-item-action">-->
<!---->
<!--                        <p class="text-left">对齐文本</p>-->
<!---->
<!--                        <p class="text-right small">2018-01-01</p>-->
<!--                    </a>-->
                </div>
            </div>
        </div>
        <div class="col-md-10 column right-container">

            <div class="right-container">

                <div id="form-examination">
                    <form name="examination" id="examination">
<!--                        <div class="row">-->

                            <div class="col-md-12 examination-title">
                                <div class="input-group">
                                    <span class="input-group-addon" style="font-size: 30px">试卷标题：</span>
                                    <input type="text" value="四川师范大学辅导员工作学生调查问卷"  class="form-control title" placeholder="请输入标题">
                                </div>
                            </div>
                            <div class="col-md-12 questions">
                                <div class="question-div">
                                    <div class="row question-item">

                                        <div class="que-title col-md-12">
                                            <div class="input-group">
                                                <span class="input-group-addon q_id">1.</span>
                                                <span class="input-mid-span">
                                                    <input type="number" class="form-control score" value="10" placeholder="选项分值" style="width: 120px">
                                                </span>
                                                <input type="text" class="form-control content" placeholder="请输入问题">
                                            </div>
                                        </div>

                                        <div class="que-select col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon mark">A.</span>
                                                <span class="input-group-addon input-mid-span">
                                                <select class="percent">
                                                    <option value="95" selected>95%</option>
                                                    <option value="90">90%</option>
                                                    <option value="85">85%</option>
                                                    <option value="80">80%</option>
                                                    <option value="75">75%</option>
                                                    <option value="70">70%</option>
                                                    <option value="65">65%</option>
                                                    <option value="60">60%</option>
                                                </select>
                                            </span>
                                                <input type="text" class="form-control content" placeholder="请输入选项">
                                            </div>
                                        </div>

                                        <div class="que-select col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon mark">B.</span>
                                                <span class="input-group-addon input-mid-span">
                                                    <select class="percent">
                                                        <option value="95">95%</option>
                                                        <option value="90" selected>90%</option>
                                                        <option value="85">85%</option>
                                                        <option value="80">80%</option>
                                                        <option value="75">75%</option>
                                                        <option value="70">70%</option>
                                                        <option value="65">65%</option>
                                                        <option value="60">60%</option>
                                                    </select>
                                                </span>
                                                <input type="text" class="form-control content" placeholder="请输入选项">
                                            </div>
                                        </div>






                                    </div>


                                    <div class="col-md-12 add-select" style="text-align: center;margin-top: 5px" >
                                        <button type="button" class="btn btn-info" onclick="addSelect(this)">添加选项</button>
                                        <button type="button" class="btn btn-warning" onclick="deleteSelect(this)">删除选项</button>
                                    </div>
                                    <hr>
                                </div>


                            </div>

                            <div class="col-md-12 add-question" style="text-align: center;margin-bottom: 10px">
                                <button type="button" class="btn btn-success" onclick="addQuestion(this);">添加问题</button>
                                <button type="button" class="btn btn-danger" onclick="deleteQuestion(this);">删除问题</button>
                            </div>
<!--                        </div>-->
                    </form>

                    <hr>
                    <div class="col-md-12" style="text-align: center;">
                        <button type="button" class="btn btn-secondary" onclick="uploadExam('examination')">提  交</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script>


    $(document).ready(function(){

        loadList();


    });

    //添加登陆判断
    //////////////////////////////////////////////////////////////////////////////
    function ifLog() {
        $.ajax({
            url: "php/admin_log_valid.php",
            type:"GET",
            success : function(response) {
                var data = JSON.parse(response);
                if(data.Status === 'failed'){
                    location.href = 'php/oauth_log.php';
                }
                else
                {
                    // loadList();
                }
            },
            error : function(result) {
                console.log("加载错误");

            }
        });
    }

    //在问题下添加选项
    function addSelect(control) {
        var que = $(control).parent().prev();
        var select_count = que.children(".que-select").length;
        if(select_count >= 26)
        {
            alert("不能添加大于26个选项！");
            return false;
        }
        var each_option_cut = que.children(".que-select").find("option").length / select_count;
//        console.log("option_cut = " + each_option_cut);
        var select_alphabet = String.fromCharCode(65 + select_count);
//        console.log(select_alphabet);

        var add_select_html = '<div class="que-select col-md-4">\n' +
            '                                            <div class="input-group">\n' +
            '                                                <span class="input-group-addon mark">' + select_alphabet + '.</span>\n' +
            '                                                <span class="input-group-addon input-mid-span">\n' +
            '                                                <select class="percent">\n';
        var percent = 100;
        for(var i = 1;i <= each_option_cut;i++)
        {

            var this_percent = percent - 5*i;
            if(i === select_count + 1 || (select_count >= each_option_cut && this_percent === percent-5*each_option_cut))
            {
                add_select_html += '<option value="' + this_percent + '" selected>' + this_percent + '%</option>\n';
            }
            else
            {
                add_select_html += '<option value="' + this_percent + '">' + this_percent + '%</option>\n';
            }
        }
        add_select_html +=
            '                                                </select>\n' +
            '                                            </span>\n' +
            '                                                <input type="text" class="form-control content" placeholder="请输入选项">\n' +
            '                                            </div>\n' +
            '                                        </div>';

        que.append(add_select_html);
//        console.log(select_count);
    }

    //删除问题下的选项
    function deleteSelect(control) {

        var que = $(control).parent().prev();

        var select_count = que.children(".que-select").length;

        if(select_count < 3)
        {
            alert("选项不能少于两个，如需删除请删除问题！");
            return false;
        }
        que.children(".que-select:last").remove();
    }

    //添加问题
    function addQuestion(control) {


        var questions = $(control).parent().prev();
        var last_question = questions.children().last();

        var q_id = parseInt(last_question.find(".question-item .que-title .q_id").text()) + 1;
//        console.log("q_id = " + q_id);
        var question_html = '<div class="question-div">\n' +
            '                                    <div class="row question-item">\n' +
            '\n' +
            '                                        <div class="que-title col-md-12">\n' +
            '                                            <div class="input-group">\n' +
            '                                                <span class="input-group-addon q_id">' + q_id + '.</span>\n' +
            '                                                <span class="input-mid-span">\n' +
            '                                                <input type="number" class="form-control score" value="10" placeholder="选项分值" style="width: 120px">\n' +
            '                                            </span>\n' +
            '                                                <input type="text" class="form-control content" placeholder="请输入问题">\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '\n' +
            '                                        <div class="que-select col-md-4">\n' +
            '                                            <div class="input-group">\n' +
            '                                                <span class="input-group-addon mark">A.</span>\n' +
            '                                                <span class="input-group-addon input-mid-span">\n' +
            '                                                <select class="percent">\n' +
            '                                                    <option value="95" selected>95%</option>\n' +
            '                                                    <option value="90">90%</option>\n' +
            '                                                    <option value="85">85%</option>\n' +
            '                                                    <option value="80">80%</option>\n' +
            '                                                    <option value="75">75%</option>\n' +
            '                                                    <option value="70">70%</option>\n' +
            '                                                    <option value="65">65%</option>\n' +
            '                                                    <option value="60">60%</option>\n' +
            '                                                </select>\n' +
            '                                            </span>\n' +
            '                                                <input type="text" class="form-control content" placeholder="请输入选项">\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '\n' +
            '                                        <div class="que-select col-md-4">\n' +
            '                                            <div class="input-group">\n' +
            '                                                <span class="input-group-addon mark">B.</span>\n' +
            '                                                <span class="input-group-addon input-mid-span">\n' +
            '                                                <select class="percent">\n' +
            '                                                    <option value="95">95%</option>\n' +
            '                                                    <option value="90" selected>90%</option>\n' +
            '                                                    <option value="85">85%</option>\n' +
            '                                                    <option value="80">80%</option>\n' +
            '                                                    <option value="75">75%</option>\n' +
            '                                                    <option value="70">70%</option>\n' +
            '                                                    <option value="65">65%</option>\n' +
            '                                                    <option value="60">60%</option>\n' +
            '                                                </select>\n' +
            '                                            </span>\n' +
            '                                                <input type="text" class="form-control content" placeholder="请输入选项">\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '\n' +
            '\n' +
            '\n' +
            '\n' +
            '\n' +
            '\n' +
            '                                    </div>\n' +
            '\n' +
            '\n' +
            '                                    <div class="col-md-12 add-select" style="text-align: center;margin-top: 5px" >\n' +
            '                                        <button type="button" class="btn btn-info" onclick="addSelect(this)">添加选项</button>\n' +
            '                                        <button type="button" class="btn btn-warning" onclick="deleteSelect(this)">删除选项</button>\n' +
            '                                    </div>\n' +
            '                                    <hr>\n' +
            '                                </div>';
        questions.append(question_html);
    }

    //删除问题
    function deleteQuestion(control) {
        var questions = $(control).parent().prev();

        var select_count = questions.children(".question-div").length;

        if(select_count < 2)
        {
            alert("不能再删除问题！");
            return false;
        }
        questions.children(".question-div:last").remove();
    }

    //加载左边模板列表
    function loadList() {
        $.ajax({
            url: "php/template_list.php",
            type:"GET",
            success : function(response) {
//                var response =
//                console.log(response);
                var data = JSON.parse(response);
//                console.log(data);
                if(data.Status === 'success'){
                    var html_list = '';
//                    console.log( data.Ret_Data[0].template_title.toString() );
                    for(var i = 0;i < data.Ret_Data.length;i++)
                    {
                        html_list += '<a href="#" class="list-group-item list-group-item-action" template_id="' + data.Ret_Data[i].template_id + '">\n' +
                            '\n' +
                            '                        <p class="text-left">' + data.Ret_Data[i].template_title + '</p>\n' +
                            '\n' +
                            '                        <p class="text-right small">' + data.Ret_Data[i].c_time + '</p>\n' +
                            '                    </a>'
                    }

                    $(".left-container .template_list").html(html_list);

                }
                else
                {

                }
            },
            error : function(result) {
                console.log("加载错误!");
            }
        });
    }

    //上传Json字符串到后端
    function uploadExam(from_id) {
        if(checkAnswer(from_id) === false)
        {
            return false;
        }
        else
        {
            var json_str = getExamJsonString(from_id);
            $.ajax({
                url: "php/template_new.php",
                type:"POST",
                data:json_str,
                success : function(response) {
                    var data = JSON.parse(response);
                    if(data.Status === 'success'){
                        alert("新建问卷模板成功！");
                    }
                    else
                    {
                        alert("新建问卷模板失败！请稍后重试");
                    }
                },
                error : function(result) {
                    alert("传输错误，请稍后重试！");
                    console.log("加载错误!");
                }
            });
        }

        //用于检查某个问题是否选择，若未选择就自动滚动至第一个未选择位置并弹出自定义标签弹窗
        //form_id : form标签的 id 字符串
        function checkAnswer(from_id) {
            var return_val = true;

            $("#" + from_id).find("input").each(function () {
                var val = trim($(this).val());  //通过判断radio元素的值来判断是否选中
                if(val === ""){
                    // alert("什么也没选中!");
                    var input_title_offset = $(this).offset().top;   //相对偏移量 用于自动滚动定位
//                    console.log(input_title_offset);
                    $("html,body").animate({scrollTop:input_title_offset},500);   //滚动到指定位置

                    $(this).parent().append("<div class='alert_box'>请填写完整！</div>");    //添加自定义提示框
                    $(".alert_box").fadeOut(3000);
                    //return false;   //存在未选择项时返回false
//                console.log("test");
                    return_val = false;

                    return false;   //结束循环，不再判断其他未选择项
                }
            });
            return return_val; //已经全部选择时返回true
        }

        //将表单数据转换为json字符串
        function getExamJsonString(from_id) {

            var title = $("#" + from_id + " .examination-title input").val();
//            console.log("title = " + title);
            var exam_json = {
                    "Description":"",
                    "Title":title,
                    "Ret_Data":[]
            };


            $("#" + from_id + " .questions").find(".question-div").each(function () {

                var q_id = parseInt($(this).find(".q_id").text());
                var content = trim($(this).find(".que-title .content").val());
                var score = $(this).find(".score").val();
                var question = {
                    "q_id":q_id,
                    "content":content,
                    "score":score,
                    "selectors":[]
                };
                $(this).find(".que-select").each(function () {
                    var mark = $(this).find(".mark").text().substr(0,1);
                    var s_id = mark.charCodeAt() - 64;
                    var content = trim($(this).find(".content").val());
                    var percent = $(this).find(".content").val();
//                    console.log("mark = " + mark + "s_id = " + s_id);
                    var selectors = {
                       "s_id":s_id,
                       "mark":mark,
                       "content":content,
                       "percent":percent
                    };
                    question.selectors.push(selectors);
                });

                exam_json.Ret_Data.push(question);
            });

            console.log(exam_json);
            return JSON.stringify(exam_json);

        }

        //去掉字符串左右的空格
        function trim(s){
            return s.replace(/(^\s*)|(\s*$)/g, "");
        }

    }

</script>
</html>
