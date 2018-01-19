<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\Helpers\Url;
use yii\Helpers\ArrayHelper;
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
<style type="text/css">
    input:-webkit-autofill , textarea:-webkit-autofill, select:-webkit-autofill {
        -webkit-text-fill-color: #ededed !important;
        -webkit-box-shadow: 0 0 0px 1000px transparent  inset !important;

        background-color:transparent;
        background-image: none;
        transition: background-color 50000s ease-in-out 0s; //背景色透明  生效时长  过渡效果  启用时延迟的时间
    }
    input {
        background-color:transparent;color:#fff; }
    .btn,.register{
        background: none;border: 2px solid #fff;width: 100%;border-radius: 15px;height: 40px;color:#fff;opacity: 0.4; }
    .register{  background: #448BCD;  border: 2px solid #448BCD;  opacity: 0.5;
    }
    .btn:hover{  background: #fff;  opacity: 1;  color: #000;  transition: 1s;
    }
    .help-block{  display: none;
    }
    input::-webkit-outer-spin-button,input::-webkit-inner-spin-button{-webkit-appearance: none !important;}/*兼容谷歌nunmber无图标*/
    input[type="number"]{-moz-appearance:textfield;}/*兼容火狐nunmber无图标*/

    select {
        /*Chrome和Firefox里面的边框是不一样的，所以复写了一下*/
        border: none;
        /*很关键：将默认的select选择框样式清除*/
        appearance:none;
        -moz-appearance:none;
        -webkit-appearance:none;
        /*将背景改为红色*/
        background:none;
        /*加padding防止文字覆盖*/
        padding-right: 14px;
        color:#535170;
        width:60%;
        font-size: 1.0em;
        margin-left:15%;
        margin-top:3%;
    }
    /*清除ie的默认选择框样式清除，隐藏下拉箭头*/
    select::-ms-expand { display: none; }
    .u_tel{
        width: 25px;
        height: 25px;
        background: url(assets/login/img/login_ico.png);
        background-position:  -85px -155px;
        position: absolute;
        margin: 10px 13px;
    }
    .dep{
        width: 25px;
        height: 25px;
        background: url(assets/login/img/login_ico.png);
        background-position:  -85px -34px;
        position: absolute;
        margin: 10px 13px;
    }
</style>
<body>
<div class="container demo-1">
    <div class="content">
        <div id="large-header" class="large-header">
            <!--<canvas id="demo-canvas"></canvas>-->
            <div class="logo_box">
                <h1>用户注册</h1>
                <?php $form = ActiveForm::begin(); ?>
                <div class="input_outer">
                    <span class="u_user"></span>
                    <?= $form->field($model, 'oa_uname',['inputOptions' => ['placeholder'=>'请输入真实姓名','class' => 'text','id'=>'name']])->label(false) ?>
                </div>
                <div class="input_outer">
                    <span class="us_uer"></span>
                    <?= $form->field($model, 'oa_pwd',['inputOptions' => ['placeholder'=>'请输入密码','class' => 'text','id'=>'pwd']])->label(false) ?>
                </div>
                <div class="input_outer">
                    <span class="u_tel"></span>
                    <?= $form->field($model, 'oa_utel',['inputOptions' => ['placeholder'=>'请输入手机号','class' => 'text','id'=>'tel','type'=>'number']])->label(false) ?>
                    <div class="help-block">手机号格式错误。</div>
                </div>
                <div class="input_outer">
                    <span class="dep"></span>
                <?= $form->field($model, 'dep_id')->dropDownList(ArrayHelper::map($dep, 'dep_id', 'dep_name'),['prompt'=>'请选择'])->label(false) ?>
                    <div class="help-block" id="help">未选择部门。</div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('开始', ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="form-group" style="margin-top: 10px">
                    <?= Html::Button('返回', ['class' => 'register btn-primary','name'=>'register']) ?>
                </div>


                <?php ActiveForm::end(); ?>

            </div><!-- /container -->
            <script src="assets/login/js/TweenLite.min.js"></script>
            <script src="assets/login/js/EasePack.min.js"></script>
            <script src="assets/login/js/rAF.js"></script>
            <script src="assets/login/js/jquery.js"></script>
            <script src="assets/login/js/demo-1.js"></script>
            <script>
                $(".register").click(function () {
                    history.back(-1);
                });
               $(".btn").click(function () {
                  /*  alert($("#tel").val());*/
                    var sMobile =$("#tel").val();
                    if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(sMobile))){
                        $(".help-block").show();
                        return false;
                    }
                    if($("#oauser-dep_id").val()=='')
                    {
                        $("#help").show();
                        return false;
                        return;
                    }

                });
            </script>
</body>
</html>