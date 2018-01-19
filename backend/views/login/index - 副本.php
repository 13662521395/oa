
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
        background-color:transparent;
    }
    .btn{
        background: #fff;
        border: none;
        width: 100%;
        border-radius: 15px;
        height: 40px;
        color:#000;
        opacity: 0.4;
    }
    .btn:hover{
        background: #fff;
        opacity: 1;
        transition: 1s;
    }
</style>
<body>
<div class="container demo-1">
    <div class="content">
        <div id="large-header" class="large-header">
            <canvas id="demo-canvas"></canvas>
            <div class="logo_box">
                <h1>山东交通职业学院</h1>
                <!--<form action="#" name="f" method="post">
                    <div class="input_outer">
                        <span class="u_user"></span>
                        <input name="logname" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">
                    </div>
                    <div class="input_outer">
                        <span class="us_uer"></span>
                        <input name="logpass" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
                    </div>
                    <div class="mb2">
                        <input type="submit" name="submit" class="btn" value="登录">
                    </div>
                </form>-->
            </div>
        </div>
    </div>
</div><!-- /container -->
<script src="assets/login/js/TweenLite.min.js"></script>
<script src="assets/login/js/EasePack.min.js"></script>
<script src="assets/login/js/rAF.js"></script>
<script src="assets/login/js/demo-1.js"></script>

</body>
</html>