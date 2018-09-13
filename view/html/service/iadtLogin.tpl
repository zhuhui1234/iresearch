<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico" mce_href="//data.iresearch.com.cn/images/favicon.ico" type="image/x-icon">

    <title>LOGIN</title>
</head>
<style>
    html,
    body{
        padding: 0;
        margin: 0;
        background: #f2f2f2;
        font-family: "Microsoft Yahei"
        font-size: 14px;
    }
    .login{
        width: 600px;
        margin: 100px auto 0 auto;
        border-top: 5px solid #b5ce11;
    }
    .login-header{
        background: #f9f9f9 url("./public/vfc_img/background.png") no-repeat;
        background-size: cover;
        height: 150px;
        text-align: center;
    }
    .login-header img{
        display: inline-block;
        margin-top: 70px;
    }
    .logo1{
        width: 150px;
        padding-right: 20px;
        margin-right: 20px;
        border-right: 1px solid #b5ce11;
    }
    .logo2{
        width: 50px;
    }
    .login-body{
        padding: 50px 150px 10px 150px;
        margin: 0 auto;
        background: #fff;
        border-top: 1px solid #eee;
    }
    .login-form{
        position: relative;
        border: 1px solid #d2d2d2;
        padding: 0px 15px;
        margin-bottom: 20px;
    }
    .login-form label{
        width: 100px;
        color: #333;
        line-height: 40px;
    }
    .login-form input{
        border: none;
        outline: none;
        width: 190px;
        font-size: 14px;
        float: right;
        height: 38px;
    }
    .login-btn{
        display: block;
        padding: 10px 0;
        background: #b5ce11;
        color: #fff;
        width: 100%;
        border: none;
        outline: none;
        font-size: 16px;
        cursor: pointer;
    }
    .error{
        color: #ed5259;
        text-align: center;
        font-size: 14px;
    }
    .error img{
        vertical-align: middle;
    }
    .copyright{
        color: #999;
        margin-top: 50px;
        font-size: 14px;
        text-align: center;
    }
</style>
<body>
<div class="login">
    <div class="login-header">
        <img src="./public/vfc_img/iad.png" alt="" class="logo1">
        <img src="./public/vfc_img/vf.png" alt="" class="logo2">
    </div>
    <div class="login-body">
        <p class="error">
            <!--<img src="./public/vfc_img/icon.png" alt="" height="14">
            请输入正确的账号密码-->
        </p>
        <form action="?m=service&a=toiAdT" method="post">
        <div class="login-form">
            <label>
                用户名：
            </label>
            <input type="text" name="mail" value="">
        </div>
        <div class="login-form">
            <label>
                密码：
            </label>
            <input type="password" name="pwd" value="">
        </div>
        <input type="submit" class="login-btn" />
        </form>
        <p class="copyright">2002-2017 Copyright © 艾瑞咨询集团</p>
    </div>
</div>
</body>
</html>