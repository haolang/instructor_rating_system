<?php
///**
// * Created by PhpStorm.
// * User: Shinelon
// * Date: 2018/1/23
// * Time: 14:35
// */
//
//?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->
    <title>Title</title>
    <!--<script type="text/javascript" src="jslib/jquery/jquery-3.2.1.min.js"></script>-->
    <style>
        /**{*/
        /*margin: 0;*/
        /*padding: 0;*/
        /*}*/
        .container{
            padding: 200px 0;
            background-image: url("img/login/background.png");
            background-size: 100% 100%;
            background-repeat: no-repeat;
            height: auto;
        }
        .login{
            width:350px;
            height: 500px;
            margin:0 auto;
            /*padding: 100px 0px;*/
            /*margin-top: 5em;*/
            box-shadow: 0px 0px 50px -10px white;
            transition: all 0.5s;
        }
        .login-logo{
            height: 200px;
        }
        .login-form{
            width:255px;
            margin: 0 auto;
        }
        .login-input{
            width: 255px;
            margin-bottom: 10px;
            border-bottom:1px solid white;
            margin-top: 30px;
        }
        .login-input input{
            background-color: rgba(0,0,0,0);
            height: 25px;
            border: none;
            font-size: 16px;
            margin: 0 15px;
            outline:none;
            padding: 3px 0;
        }
        .login-input input:focus{
            color: white;
        }
        .login-a{
            text-decoration: none;
            color: white;
            font-size: 14px;
            margin-left: 125px;
        }
        .login-sub input{
            height: auto;
            width: 150px;
            color: white;
            font-size: 20px;
            border-radius: 10px;
            background-color: #5a91c5;
            margin: 20px 0 0 55px;
            cursor: pointer;
            padding: 9px 0;
        }
        .login-sub{
            border: none;
            background-color: transparent;
        }
        .login-sub input:hover
        {

            background-color: #60ace6;

            box-shadow: 0px 0px 40px -10px white;
        }
        /*@media screen and (max-width: 400px){*/
        /*.login{*/
        /*width: 100%;*/
        /*box-shadow: none;*/
        /*}*/
        /*}*/



    </style>

</head>
<body>
<div class="container">
    <div class="login">
        <div class="login-logo">

        </div>
        <div class="login-form">
            <form action="">
                <div class="login-input">
                    <img src="img/login/user_icon.png" alt="">
                    <input type="text"name="username" id="username" autocomplete="off"  placeholder="User name">
                    <!--<a href="#"><img src="img/login/up_arrows.png" alt=""></a>-->
                </div>
                <div class="login-input">
                    <img src="img/login/password_icon.png" alt="">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <!--<a href="#"><img src="img/login/password_open_eye.png" alt=""></a>-->
                </div>
                <a href="#" class="login-a">忘记密码</a>
                <div class="login-input login-sub">
                    <input type="submit" value="登&nbsp;&nbsp;录">
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>