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

        /*自定义弹出提示框******************************************************************/
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
        /***************************************************************自定义弹出提示框*/

        /*大标题*/
        .top-container
        {
            margin-top:20px;
        }

        /*左边部分*******************************************************************************************/
        .template-list p,.paper-list p
        {
            margin: 0;
            padding:0;
        }
        .template-list,.paper-list
        {
            padding: 0;
        }
        /*模板列表div**************************************************************/

        /*模板列表删除修改按钮div*/
        .template-list-buttons-item,.paper-list-buttons-item
        {
            position: absolute;
            bottom: 3px;
            right: 3px;
            /*display: none;*/
            opacity: 0;
            margin: 3px;
            transition: all 0.5s;
            background-color: #a8a8a8;
        }

        .template-list-item:hover .template-list-buttons-item,.paper-list-item:hover .paper-list-buttons-item
        {
            /*display: block;*/
            box-shadow: 2px 2px 5px;
            opacity: 1;
        }



        /**************************************************************模板列表div*/



        .paper
        {
            margin-top: 5px;
        }


        /*******************************************************************************************左边部分*/


        /*右边部分******************************************************************************************/

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



        .right-container-title
        {
            text-align: center;
            /*margin: 5px auto;*/
        }

        .right-container
        {
            border-left:3px solid #d6d8d9;
        }


        /******************************************************************************************右边部分*/

        /*问卷弹出模态框********************************************************************************/
        .alert-modal
        {

            z-index: 999;
            position: absolute;
            top: 0;
            /*right: 0;*/
            /*bottom: 0;*/
            left: 0;
            width: 100%;
            display: none;
            background-color: rgba(0,0,0,0.7);
            opacity:0;
        }
        .alert-paper-content
        {
            /*z-index: 999;*/
            /*width: 800px;*/
            /*height: 500px;*/
            margin: 10px auto 20px auto;
            position: relative;
            width: 700px;
            /*height: 95%;*/
            /*overflow-y: scroll;*/

            background-color: #e2e3e5;
            border-radius: 10px;
        }
        .paper-head
        {
            border-bottom: 1px solid #393939;
            border-radius: 10px 10px 0 0;
            background-color: #b4b4b4;
            padding: 10px 5px;
        }
        .alert-paper-title
        {
            text-align: center;
        }
        .paper-alert-close-button-top
        {
            float: right;
            outline: none;
            border: none;
            margin: 5px;
            font-size: 20px;
            background-color: transparent;
        }

        .question-title{

            font-size: 20px;
            margin-bottom: 5px;
        }
        .question
        {
            margin: 10px 0;
        }

        .question-select label
        {
            margin-right: 30px;
            display: inline-block;
        }

        .paper-questions
        {
            width: 700px;
            margin: 5px 30px;
        }
        .paper-foot
        {
            border-top: 1px solid #393939;
            bottom: 0;
            width: 100%;
            background-color: #b4b4b4;

            border-radius:0 0 10px 10px;
            text-align: center;
            margin: 0 auto;
        }
        .paper-foot button
        {
            margin: 10px;
            /*text-align: center;*/
        }
        .paper-alert-close-button-top
        {
            position: absolute;
            border-radius: 7px;
            padding: 0 8px 2px 8px;
            right:3px;
            top:3px;
            border: 1px solid #848485;
        }
        .paper-alert-close-button-foot:hover ,.paper-alert-close-button-top:hover
        {
            background-color: #7a7a7a;
        }

        /********************************************************************************问卷弹出模态框*/
    </style>
</head>
<body>





<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="top-container alert alert-secondary">
                <h1 style="text-align: center">模板管理</h1>
            </div>
        </div>
        <div class="col-md-2 column">

            <div class="left-container">

                    <div class="card template">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                模板列表
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse show">
                            <div class="card-body template-list">

                            </div>
                        </div>
                    </div>

                    <div class="card paper">
                        <div class="card-header">
                            <a class="collapsed" data-toggle="collapse"  href="#collapseTwo">
                                问卷列表
                            </a>
                        </div>
                        <div id="collapseTwo" class="collapse show">
                            <div class="card-body paper-list">

                            </div>
                        </div>
                    </div>


            </div>




        </div>


        <div class="col-md-10 column right-container">

            <div class="right-container-item">
                <div class="right-container-title">
                    <h4>新建模板</h4>
                </div>
                <div id="form-examination">
                    <form name="examination" id="examination">
<!--                        <div class="row">-->

                            <div class="col-md-12 examination-title">
                                <div class="input-group">
                                    <span class="input-group-addon" style="font-size: 20px">试卷标题：</span>
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
                                        <button type="button" class="btn btn-info btn-sm btn-add-select">添加选项</button>
                                        <button type="button" class="btn btn-warning btn-sm btn-delete-select">删除选项</button>
                                    </div>
                                    <hr>
                                </div>


                            </div>

                            <div class="col-md-12 add-question" style="text-align: center;margin-bottom: 10px">
                                <button type="button" class="btn btn-success btn-add-question">添加问题</button>
                                <button type="button" class="btn btn-danger btn-delete-question">删除问题</button>
                            </div>
<!--                        </div>-->
                    </form>

                    <hr>
                    <div class="col-md-12" style="text-align: center;margin-bottom: 10px;">
                        <button id="btn-upload-examination" type="button" class="btn btn-secondary btn-lg">提交新建模板</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alert-modal">
    <div class="alert-paper-content">
        <div class="alert-paper">
            <div class="paper-head">
                <button type="button" class="paper-alert-close-button-top">×</button>
                <h4 class="alert-paper-title">
                    调查问卷
                </h4>
            </div>
            <div class="paper-body">
                <div id="paper-questions" class="paper-questions">

<!--                    <div class="question">-->
<!---->
<!--                        <div class="question-title">1、将数据存储于数据库。</div>-->
<!--                        <div class="question-select">-->
<!--                            <label><input type="radio" name="qid_1" value="95" class="q-select">A、好</label>-->
<!--                            <label><input type="radio" name="qid_1" value="80" class="q-select">B、一般</label>-->
<!--                            <label><input type="radio" name="qid_1" value="80" class="q-select">B、一般</label>-->
<!--                            <label><input type="radio" name="qid_1" value="80" class="q-select">B、一般</label>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>

            </div>
            <div class="paper-foot">
                <button class="btn paper-alert-close-button-foot">关 闭</button>
            </div>
        </div>
    </div>
</div>



</body>
<script>

    //左侧模板列表事件
    var TempListEvent = {

        html_paper_id : "paper-questions",


        bindClick:function () {
            var that = this;
            //模板设置为问卷按钮
            $(document).on("click",".set-paper-new",function() {
                console.log("设为问卷");
                var Paper_title = $(this).parent().siblings(".template-title").text();
                var Template_id = $(this).parent().parent().attr("template_id");
    //                    console.log("Paper_title = " + Paper_title);
    //                    console.log("Template_id = " + Template_id);

                $.ajax({
                    url: "php/paper_new.php",
                    type:"POST",
                    data:{
                        "Paper_title" : Paper_title,
                        "Template_id" : Template_id
                    },
                    success : function(response) {
                        var data = JSON.parse(response);
                        console.log(data);
                        if(data.Status === 'success' || data.StatusCode === 1)
                        {
                            alert("已成功设为问卷！");
                        }
                        else if(data.Status === "failed" || data.StatusCode === 0)
                        {
                            alert("设为问卷失败！请稍后重试。");
                        }

                    },
                    error : function(result) {
                        console.log("数据传输错误!");
                    }
                });

            });
            //删除模板按钮
            $(document).on("click",".template-delete",function() {

                if(confirm("是否删除模板？\n   不可撤销！") === true)
                {
                    var template_list = $(this).parent().parent();
                    var template_id = template_list.attr("template_id");
                    console.log("template_id = " + template_id);
                    $.ajax({
                        url: "php/template_delete.php",
                        type:"GET",
                        data:{
                            "template_id" : template_id
                        },
                        success : function(response) {
                            var data = JSON.parse(response);
                            console.log(data);
                            if(data.Status === 'success' || data.StatusCode === 1)
                            {
                                alert("删除模板成功！");
                                template_list.fadeOut(500,function () {
                                    $(this).remove();
                                });
                            }
                            else if(data.Status === "failed" || data.StatusCode === 0)
                            {
                                alert("删除模板失败！");
                            }

                        },
                        error : function(result) {
                            console.log("数据传输错误!");
                        }
                    });
                }
                else
                {
                    console.log("取消");
                }
            });
            var template_btn_leave = true;
            $(document).on("mouseleave",".template-list-buttons-item",function () {
                template_btn_leave = true;
            });

            $(document).on("mouseenter",".template-list-buttons-item",function () {
                template_btn_leave = false;
            });

            //动态绑定点击事件到模板列表元素上
            $(document).on("click",".template-list-item",function() {
                console.log("查看模板");
                if(template_btn_leave)
                {

                    var template_id = $(this).attr("template_id");
                    if(that.loadTemplate(template_id))
                    {
                        //改变选中的模板列表元素的背景颜色
                        $(".template-list-item").css("background-color","#ffffff");
                        $(this).css("background-color","#e2e3e5");
                    }
                }

            });




            //问卷启用按钮
            $(document).on("click",".paper-enable",function() {

                if(confirm("是否启用问卷？") === true)
                {
                    var paper_list = $(this).parent().parent();
                    var template_id = paper_list.attr("template_id");
                    var paper_id = paper_list.attr("paper_id");
                    console.log("template_id = " + template_id);
                    console.log("paper_id = " + paper_id);
                    $.ajax({
                        url: "php/paper_enable.php",
                        type:"GET",
                        data:{
                            "paper_id" : paper_id
                        },
                        success : function(response) {
                            var data = JSON.parse(response);
                            console.log(data);
                            if(data.Status === 'success' || data.StatusCode === 1)
                            {
                                alert("问卷启用成功！");
                                //改变按钮为禁用按钮
                            }
                            else if(data.Status === "failed" || data.StatusCode === 0)
                            {
                                alert("问卷启用失败！请稍后重试");
                            }

                        },
                        error : function(result) {
                            console.log("问卷数据传输错误!");
                        }
                    });
                }
                else
                {
                    console.log("取消");
                }
            });

            //问卷删除按钮
            $(document).on("click",".paper-delete",function() {

                if(confirm("是否删除问卷？") === true)
                {
                    var paper_list = $(this).parent().parent();
                    var template_id = paper_list.attr("template_id");
                    var paper_id = paper_list.attr("paper_id");
                    console.log("template_id = " + template_id);
                    console.log("paper_id = " + paper_id);
                    $.ajax({
                        url: "php/paper_delete.php",
                        type:"GET",
                        data:{
                            "paper_id" : paper_id
                        },
                        success : function(response) {
                            var data = JSON.parse(response);
                            console.log(data);
                            if(data.Status === 'success' || data.StatusCode === 1)
                            {
                                alert("删除问卷成功！");
                                paper_list.fadeOut(500,function () {
                                    $(this).remove();
                                });
                            }
                            else if(data.Status === "failed" || data.StatusCode === 0)
                            {
                                alert("删除问卷失败！");
                            }

                        },
                        error : function(result) {
                            console.log("问卷数据传输错误!");
                        }
                    });
                }
                else
                {
                    console.log("取消");
                }
            });

            var paper_btn_leave = true;
            $(document).on("mouseleave",".paper-list-buttons-item",function () {
                paper_btn_leave = true;
            });
            $(document).on("mouseenter",".paper-list-buttons-item",function () {
                paper_btn_leave = false;
            });

            //查看问卷
            $(document).on("click",".paper-list-item",function() {
                console.log("查看问卷");


                if(paper_btn_leave)
                {
                    var paper_id = $(this).attr("paper_id");
                    if(that.loadPaper(paper_id))
                    {

//                    $(".alert-modal").css("display","block");
                        //改变选中的问卷列表元素的背景颜色
                        $(".paper-list-item").css("background-color","#ffffff");
                        $(this).css("background-color","#e2e3e5");

                        $(".alert-modal").css("display","block");
                        $(".alert-modal").animate({
                            opacity:1
                        },500);

                    }

                }


            });

            $(document).on("click",".paper-alert-close-button-foot,.paper-alert-close-button-top",function() {

                $(".alert-modal").animate({
                    opacity:0
                },1000,function () {
                    $(this).css("display","none");
                })
            });

        },

        //加载左边模板列表
        loadTempList:function(array_paper_template_id) {
            console.log(array_paper_template_id);
            $.ajax({
                url: "php/template_list.php",
                type:"GET",
                success : function(response) {
                    //                var response =
    //                    console.log(response);
                    var data = JSON.parse(response);
    //                    console.log(data);
                    if(data.Status === 'success' || data.StatusCode === 1){
                        var html_list = '';
                        //                    console.log( data.Ret_Data[0].template_title.toString() );
                        for(var i = 0;i < data.Ret_Data.length;i++)
                        {

                            var btn_set_paper = true;
                            var template_list_item_style = "";
                            for(var j = 0; j < array_paper_template_id.length;j++)
                            {
                                if(parseInt(array_paper_template_id[j]) === parseInt(data.Ret_Data[i].template_id))
                                {
                                    btn_set_paper = false;
                                    template_list_item_style = "opacity:0.5";
                                    break;
                                }
                            }


                            html_list += '<a href="#" style="' + template_list_item_style + '" class="list-group-item list-group-item-action template-list-item" template_id="' + data.Ret_Data[i].template_id + '">\n' +
                                '\n' +
                                '                        <p class="text-left template-title">' + data.Ret_Data[i].template_title + '</p>\n' +
                                '                        <p class="text-right small">' + data.Ret_Data[i].c_time + '</p>\n' +
                                '                        <div class="template-list-buttons-item">';

                            if(btn_set_paper)
                            {
                                html_list += '<button class="btn btn-success btn-sm set-paper-new">设为问卷</button>';
                            }


                            html_list += '<button class="btn btn-warning btn-sm template-delete">删除</button>' +
                                '</div>\n' +
                                '                    </a>';
                        }

                        $(".left-container .template-list").append(html_list);
                        //                    console.log(html_list);

                    }
                    else if(data.Status === 'failed' || data.StatusCode === 0)
                    {
                        alert("模板列表数据请求失败！");
                    }
                },
                error : function(result) {
                    console.log("加载错误!");
                }
            });
        },
        //加载左侧问卷列表
        loadPaperList:function() {

            $.ajax({
                url: "php/paper_list.php",
                type:"GET",
                success : function(response) {
                    //                var response =
    //                    console.log(response);
                    var data = JSON.parse(response);
                    var array_paper_template_id = [];
    //                    console.log(data);
                    if(data.Status === 'success' || data.StatusCode === 1){
                        var html_list = '';
                        //                    console.log( data.Ret_Data[0].template_title.toString() );
                        for(var i = 0;i < data.Ret_Data.length;i++)
                        {
                            var btn_paper_enable_text = "";
                            var paper_list_item_style = "";
                            array_paper_template_id.push(data.Ret_Data[i].template_id);   //用于显示已经设定的
                            if(data.Ret_Data[i].status === 0)
                            {
                                btn_paper_enable_text = "启用问卷";
                                paper_list_item_style = "opacity:0.5;";
                            }
                            else if(data.Ret_Data[i].status === 1)
                            {
                                btn_paper_enable_text = "禁用问卷";
                            }

                            html_list += '<a href="#" style="' + paper_list_item_style + '" class="list-group-item list-group-item-action paper-list-item" paper_id="' + data.Ret_Data[i].paper_id + '" template_id="' + data.Ret_Data[i].template_id + '">\n' +
                                '\n' +
                                '                        <p class="text-left paper-title">' + data.Ret_Data[i].title + '</p>\n' +
                                '                        <p class="text-right small">' + data.Ret_Data[i].c_time + '</p>\n' +
                                '                        <div class="paper-list-buttons-item">' +

                                '<button class="btn btn-success btn-sm paper-enable">' + btn_paper_enable_text +
                                '</button>' +
                                '<button class="btn btn-warning btn-sm paper-delete">删除</button>' +
                                '</div>\n' +
                                '                    </a>';
                        }

                        $(".left-container .paper-list").append(html_list);
                        //                    console.log(html_list);

                        TempListEvent.loadTempList(array_paper_template_id);  //异步加载左侧模板列表

                    }
                    else if(data.Status === 'failed' || data.StatusCode === 0)
                    {
                        alert("问卷列表数据请求失败！");
                    }
                },
                error : function(result) {
                    console.log("加载错误!");
                }
            });
        },
        //根据模板id加载模板
        loadTemplate:function(template_id) {
            var return_val = true;
            var that = this;
            $.ajax({
                url: "php/template_que_items.php",
                type:"GET",
                data:{
                    template_id:template_id
                },
                success : function(response) {
                    var data = JSON.parse(response);
                    if(data.Status === 'success' || data.StatusCode === 1){

                        that.InitTemplate();    //初始化右边新建模板html 部分到只有一个问题和两个选项
                        var que_list = data.Ret_Data;

                        $("#examination .examination-title .title").val(data.Title);  //动态加载标题

                        var JQ_questions = $("#examination .questions");

                        var JQ_question_div = JQ_questions.children(".question-div");
                        for(var i = 0;i < que_list.length; i++)
                        {
                            var que = que_list[i];
                            if(i >= JQ_question_div.length)  //添加问题
                            {
                                $(".btn-add-question").click();
                                JQ_question_div = JQ_questions.children(".question-div");
    //                                    console.log(JQ_question_div.length);
                            }

                            JQ_question_div.eq(i).find(".score").val(que.score);  //数据加载至页面
                            JQ_question_div.eq(i).find(".content").val(que.content); //数据加载至页面

    //                                console.log("i = " + i);
                            var JQ_que_selects = JQ_question_div.eq(i).find(".que-select");
    //                                console.log(JQ_que_selects);
                            for(var j = 0;j < que.selectors.length; j++)
                            {

                                var select = que.selectors[j];
    //                                    console.log(JQ_que_select);
                                if(j >= JQ_que_selects.length)
                                {
                                    JQ_question_div.eq(i).find(".btn-add-select").click();
    //                                        console.log("click");
                                }
                                JQ_que_selects = JQ_question_div.eq(i).find(".que-select");

                                JQ_que_selects.eq(j).find(".percent").val(select.percent);
                                JQ_que_selects.eq(j).find(".content").val(select.content);



    //                                    content += '<li class="q-answer"><label><input type="radio" name="qid_'+ que.q_id + '" value="'+ select.percent +'" class="q-select">'+select.mark+'、'+select.content+'</label></li>\n';
                            }
    //                                content +='            </ul>';
                        }

    //                            console.log(data);
                    }
                    else if(data.Status === 'failed' || data.StatusCode === 0)
                    {
                        return_val = false;
                        alert("加载模板失败！");
                    }
                },
                error : function(result) {
                    alert("传输错误，请稍后重试！");
                    console.log(result);
                }
            });
            return return_val;
        },
        //根据问卷id加载问卷到自定义弹窗
        loadPaper:function (paper_id) {

            var return_val = true;
            var that = this;
            $.ajax({
                url: "php/que_list.php",
                type:"GET",
                data:{
                    que_id:paper_id
                },
                success : function(response) {
                    var data = JSON.parse(response);
                    //todo 添加failed 判断
//                console.log(data);
                    var que_list = data.Ret_Data;
                    var content = '';
                    for(var i = 0;i < que_list.length; i++)
                    {
                        var que = que_list[i];


                        content +=
                            '                    <div class="question">\n' +
                            '\n' +
                            '                        <div class="question-title">' +(i+1)+'、'+ que.content + '</div>\n' +
                            '                        <div class="question-select">\n';
                        for(var j = 0;j < que.selectors.length; j++)
                        {
                            var select = que.selectors[j];
                            content += '<label><input type="radio" name="qid_'+ que.q_id + '" value="'+ select.percent +'" class="q-select">'+select.mark+'、'+select.content+'</label>\n';
                        }

                        content += '                        </div>\n' +
                            '                    </div>';

                    }

                    $("#" + that.html_paper_id).html(content);
//                console.log(content);
                },
                error : function() {
//                console.log(result);
                    console.log("加载错误");
                }

            });
            return return_val;
        },

        //初始化模板html 部分到只有一个问题和两个选项
        InitTemplate:function () {

            var JQ_question_div = $("#examination").find(".question-div");
            var que_lenght =  JQ_question_div.length;

    //                console.log("que_lenght = " + que_lenght);
            for(var i = que_lenght; i > 1;i--)
            {
                JQ_question_div[i-1].remove();  //移除多余的问题和选项
            }

            var JQ_question_select = $(".question-div").find(".que-select");
    //                console.log(JQ_question_select);
            var JQ_question_select_length = JQ_question_select.length;
    //                console.log("JQ_question_select_length = " + JQ_question_select_length);
            for(var j = JQ_question_select_length; j > 1;j--)
            {
                JQ_question_select[j-1].remove();   //移除第一个问题的多余的空白选项
            }

        }

    };


    //右侧模板事件
    var ExamEvent = {
        bindClick:function () {
            var that = this;
            //绑定提交事件到提交按钮上
            $("#btn-upload-examination").click(function () {
                that.uploadExam('examination');
            });

            $(document).on("click",".btn-add-select",function() {
                that.addSelect(this);
            });

            $(document).on("click",".btn-delete-select",function() {
                that.deleteSelect(this);
            });

            $(document).on("click",".btn-add-question",function() {
                that.addQuestion(this);
            });

            $(document).on("click",".btn-delete-question",function() {
                that.deleteQuestion(this);
            });
        },
        //在问题下添加选项
        addSelect:function (control) {
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
        },
        //删除问题下的选项
        deleteSelect:function(control) {

            var que = $(control).parent().prev();

            var select_count = que.children(".que-select").length;

            if(select_count < 3)
            {
                alert("选项不能少于两个，如需删除请删除问题！");
                return false;
            }
            $(control).siblings("button").attr("disabled",true);
            que.children(".que-select:last").slideUp(300,function () {
                $(this).remove();
                $(control).siblings("button").attr("disabled",false);
            });

        },
        //添加问题
        addQuestion:function(control) {


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
                '                                        <button type="button" class="btn btn-info btn-sm btn-add-select">添加选项</button>\n' +
                '                                        <button type="button" class="btn btn-warning btn-sm btn-delete-select">删除选项</button>\n' +
                '                                    </div>\n' +
                '                                    <hr>\n' +
                '                                </div>';
            questions.append(question_html);
        },
        //删除问题
        deleteQuestion:function(control) {
            var questions = $(control).parent().prev();

            var select_count = questions.children(".question-div").length;

            if(select_count < 2)
            {
                alert("不能再删除问题！");
                return false;
            }

            //删除时淡出，淡出完毕前禁用添加按钮，淡出完毕删除标签后使能添加按钮
            $(control).siblings("button").attr("disabled",true);
            questions.children(".question-div:last").slideUp(500,function () {
                $(this).remove();
                $(control).siblings("button").attr("disabled",false);
            });
        },

        //上传Json字符串到后端
        uploadExam:function(from_id) {
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
                    if(data.Status === 'success' || data.StatusCode === 1){
                        alert("新建问卷模板成功！");
                    }
                    else if(data.Status === 'failed' || data.StatusCode === 0)
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
                    $(".alert_box").fadeOut(3000,function () {
                        $(this).remove();
                    });
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

    };


    $(document).ready(function(){

        //TODO --ifLog-- 添加 ifLog 判断登陆后执行下面代码块

        {

            TempListEvent.bindClick(); //绑定右侧模板点击事件
            TempListEvent.loadPaperList();
            ExamEvent.bindClick();   //绑定左侧模板列表点击事件
        }

    });

    //添加登陆判断
    //////////////////////////////////////////////////////////////////////////////
    function ifLog() {
        $.ajax({
            url: "php/admin_log_valid.php",
            type:"GET",
            success : function(response) {
                var data = JSON.parse(response);
                if(data.Status === 'failed' || data.StatusCode === 0){
                    location.href = 'php/oauth_log.php';
                }
                else if(data.Status === "success" || data.StatusCode === 1)
                {
                    //TempListEvent.loadTempList();  //异步加载左侧模板列表 todo --ifLog-- 完善登陆后取消注释
                }
            },
            error : function(result) {
                console.log("加载错误");

            }
        });
    }





</script>
</html>
