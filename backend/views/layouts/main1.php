<!--接受客户端接收消息-->
<script src="http://cdn-hangzhou.goeasy.io/goeasy.js"></script>
<script>
    var goEasy = new GoEasy({appkey: 'BS-002f7459c5474b219756e776220a1efa'});//这里我用的是subscriber key,因为在我的客户端我不需要推送任何消息，所以没有必要使用supper key
    goEasy. subscribe({
        channel: 'csdnNotification',
        onMessage: function(message){
            var messages = message.content;
            var newcont = $('.alertbox2').html();
            $('.alertbox').html(newcont);
            $(".info").text(messages);
            $(".alertbox").slideDown('fast');
            var t=setTimeout("$('.alertbox').slideUp('slow')",5000);
        }
    });
</script>
<?php

/* @var $this \yii\web\View */
/* @var $content string */
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\Helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\web\Response;
use yii\web\Request;
$session = Yii::$app->session;
$session->open();
$a=$session->get('uid');
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
     <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--checkbox css-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link href="assets/css/checkbox/style.css" rel="stylesheet" />
    <link href="assets/css/checkbox/radiocheck.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/checkbox/build.css">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body{padding-bottom:70px;z-index: 0;}
        .alertbox,.alertbox2{
            position: fixed;
            right:0;
            bottom:0;
            z-index:10;
            display: none;
        }
    </style>
</head>
<body>
<section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg" style="background:#000;border:1px solid #000">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>Welcome to Spring_OA</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">DashGum Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hi mate, how is everything?
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-divya.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Divya Manian</span>
                                    <span class="time">40 mins.</span>
                                    </span>
                                    <span class="message">
                                     Hi, I need your help with this.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-danro.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dan Rogers</span>
                                    <span class="time">2 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Love your new Dashboard.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-sherman.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dj Sherman</span>
                                    <span class="time">4 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Please, answer asap.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li>
                        <a class="logout" href="<?=Url::toRoute(['login/loginout']);
                        ?>" style="background: #fff;color: #000;">退出</a>
                    </li>
                </ul>
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse " style="background: #000">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="<?= Url::to('user/info')?>">
                          <?php
                          $filename=$session->get('uname');
                            if(file_exists("assets/head/creat/".$session->get('uname').".jpg"))
                            {
                                echo "<img src='assets/head/creat/$filename.jpg' class='img-circle' width='60'>";
                            }
                            else
                            {
                                echo '<img src="assets/head/creat/ui-sam.jpg" class="img-circle" width="60">';
                            }
                          ?>

                      </a>
                  </p>
                  <h5 class="centered"><?=$session->get('uname');?></h5>
                    
                  <li class="mt">
                      <a  href="<?= Url::toRoute('mission/index'); ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>任务</span>
                      </a>
                  </li>
                  <li class="mt">
                      <a  href="<?= Url::toRoute('oaaffiche/index'); ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>公告</span>
                      </a>
                  </li>
                  
                  <li class="mt">
                      <a href="<?= Url::toRoute('oauser/index'); ?>" >
                          <i class="fa fa-desktop"></i>
                          <span>个人中心</span>
                      </a>
                      
                  </li>
                  <?php if($a == 1) {?>
                  
                  <li class="mt">
                      <a href="<?= Url::toRoute('oaschool/index'); ?>" >
                          <i class="fa fa-desktop"></i>
                          <span>校区</span>
                      </a>
                      
                  </li>
                  <li class="mt">
                      <a href="<?= Url::toRoute('oadepartment/index'); ?>" >
                          <i class="fa fa-desktop"></i>
                          <span>部门</span>
                      </a>
                    
                  </li>
                  <li class="mt">
                      <a  href="<?= Url::toRoute('racord/index'); ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>操作记录</span>
                      </a>
                  </li>
          <li class="sub-menu">
                      <a href="<?= Url::toRoute('oaduty/index'); ?>" >
                          <i class="fa fa-cogs"></i>
                          <span>部门职责</span>
                      </a>
                  </li>
                  <li class="mt">
                      <a href="<?= Url::toRoute('oaposition/index'); ?>" >
                          <i class="fa fa-desktop"></i>
                          <span>职位</span>
                      </a>
                  </li>
                  <?php } ?>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
    <section id="main-content"">
        <section class="wrapper">
    <!--1公共区域开始-->
            <?= $content?>
            <!--推送消息定位-->
            <div class="alertbox"></div>
            <div class="alertbox2">
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>
                        注意!
                    </h4> <strong>提示:</strong><span class="info">杜仕敏将任务"用户的curd"移动到完成!</span><a href="javascript:void(0);" class="alert-link"></a>
                </div>
            </div>
            <!--推送消息定位-->
            <!--1公共区域结束-->
        </section>
    </section>
        <!--sidebar end-->
      <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
    <script src="assets/js/zabuto_calendar.js"></script>

    <!--友情提示-->
<!--    <script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to Dashgum!',
            // (string | mandatory) the text inside the notification
            text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Free version for <a href="" target="_blank" style="color:#ffd777">BlackTie.co</a>.',
            // (string | optional) the image to display on the left
            image: 'assets/img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
    </script>-->
    
    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
</body>
</html>
<?php $this->endPage() ?>
<!--<script>
    $(".btn-success").click(function () {
        var messages = '杜仕敏将任务"用户的curd"移动到完成!';
        var newcont = $('.alertbox2').html();
        $('.alertbox').html(newcont);
        $(".info").text(messages);
        $(".alertbox").slideDown('fast');
        var t=setTimeout("$('.alertbox').slideUp('slow')",5000);
    });
</script>-->