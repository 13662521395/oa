<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="assets/login/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="assets/login/css/demo.css" />
    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="assets/login/css/component.css" />
    <!--[if IE]>
    <script src="assets/login/js/html5.js"></script>
    <![endif]-->
</head>

<body>
<div class="container demo-1">
    <div class="content">
        <div id="large-header" class="large-header">
            <canvas id="demo-canvas"></canvas>
            <div class="logo_box">
                <h1 style="font-size: 20px;">登录失败,正在跳转</h1>
                <script>
                    setTimeout(function () {

                        history.go(-1);
                    },1000);

                </script>


            </div><!-- /container -->


            <script src="assets/login/js/demo-1.js"></script>
            <!-- <script>
                 $("#pwd").blur(function () {
                     if($(this).val=='') {
                         alert('1111');
                     }
                     else {
                         alert('2222222');
                     }
                 });
             </script>-->
</body>
</html>