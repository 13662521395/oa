<html lang="en" class="no-js">
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\Helpers\Url;
use yii\web\Response;
use yii\web\Request;
$cookie = \Yii::$app->request->cookies;
$uname = empty($cookie['uname']) ? '' : $cookie['uname'];
$upwd  = empty($cookie['upwd'])  ? '' : $cookie['upwd'];
?>
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
<style type="text/css">
    input:-webkit-autofill , textarea:-webkit-autofill, select:-webkit-autofill {
        -webkit-text-fill-color: #ededed !important;
        -webkit-box-shadow: 0 0 0px 1000px transparent  inset !important;

        background-color:transparent;
        background-image: none;
        transition: background-color 50000s ease-in-out 0s; //背景色透明  生效时长  过渡效果  启用时延迟的时间
    }
    input {
        background-color:transparent;
        color:#fff;
    }
    .btn,.register{
        background: none;
        border: 2px solid #fff;
        width: 100%;
        border-radius: 15px;
        height: 40px;
        color:#fff;
        opacity: 0.4;
    }
    .register{
        background: #448BCD;
        border: 2px solid #448BCD;
        opacity: 0.5;
    }
    .btn:hover{
        background: #fff;
        opacity: 1;
        color: #000;
        transition: 1s;
    }
</style>
<body>
<div class="container demo-1">
    <div class="content">
        <div id="large-header" class="large-header">
            <!--<canvas id="demo-canvas"></canvas>-->
            <div class="logo_box">
                <h1>山东柏瑞管理系统</h1>
                <?php $form = ActiveForm::begin(); ?>
                <div class="input_outer">
                    <span class="u_user"></span>
                <?= $form->field($model, 'oa_uname',['inputOptions' => ['placeholder'=>'请输入用户名','class' => 'text','id'=>'name','value'=>$uname]])->label(false) ?>
                </div>
                <div class="input_outer">
                    <span class="us_uer"></span>
                <?= $form->field($model, 'oa_pwd',['inputOptions' => ['placeholder'=>'请输入密码','class' => 'text','id'=>'pwd','type'=>'password','value'=>$upwd]])->label(false) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary']) ?>
                </div>

                <!--<div class="form-group" style="margin-top: 10px">
                    <?= Html::Button('注册', ['class' => 'register btn-primary','name'=>'register']) ?>
                </div>-->


                <?php ActiveForm::end(); ?>

</div><!-- /container -->
<script src="assets/login/js/TweenLite.min.js"></script>
<script src="assets/login/js/EasePack.min.js"></script>
<script src="assets/login/js/rAF.js"></script>
<script src="assets/login/js/jquery.js"></script>
<script src="assets/login/js/demo-1.js"></script>
           <script>
                $(".register").click(function () {
                    location.href ="<?=Url::toRoute('login/register');?>";
                });
            </script>
</body>
</html>