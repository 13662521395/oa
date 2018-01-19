<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use app\models\OaMission;
use app\models\OaUser;
use app\models\OaMissionLog;
$session = Yii::$app->session;
$session->open();
$a=$session->get('uid');
AppAsset::register($this);
/*查出状态为进行中的任务和数值*/
$sql = "select * from `oa_mission` where m_complete=1 and m_id in(select m_id from `oa_mission` where m_joinusers like '%$a%' )";
$com = Yii::$app->db->createCommand($sql)->queryAll();

$sql_c = "select count(*) as aa from `oa_mission` where m_complete=1 and m_id in(select m_id from `oa_mission` where m_joinusers like '%$a%' )";
$result_c = Yii::$app->db->createCommand($sql_c)->queryAll();
/*查询开始任务和完成任务后提示*/
$model = new OaMissionLog;
$com_s = $model->find()->with('oaUser')->where(['mlog_type'=>'开始任务','mlog_status'=>'0'])->all();

$com_w = $model->find()->with('oaUser')->where(['mlog_type'=>'完成任务','mlog_status'=>'0'])->all();

$com_shu = $model->find()->where(['mlog_status'=>'0'])->count();/*未阅读任务状态*/
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <?= Html::csrfMetaTags() ?>
    <!-- basic styles -->

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.full.min.css" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
    <!--[if IE 7]>
    <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
    <![endif]-->

    <!-- page specific plugin styles -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/jquery.treeview.js"></script>
    <!-- fonts -->

    <link rel="stylesheet" href="assets/js/family.js" />

    <!--  date picker  -->
    <link rel="stylesheet" href="assets/css/datepicker.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="stylesheet" href="css/jquery.treeview.css" />
    <!-- ace styles -->

    <link rel="stylesheet" href="assets/css/ace.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->

    <script src="assets/js/ace-extra.min.js"></script>

    

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    <i class="icon-leaf"></i>
                    山东柏瑞管理系统
                </small>
            </a><!-- /.brand -->
        </div><!-- /.navbar-header -->

        <div class="navbar-header pull-right" role="navigation">
        
            <ul class="nav ace-nav">
            
                <li class="grey">
                    <?php foreach($result_c as $com3):?>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="ren">
                        <i class="icon-tasks"></i>
                        <span class="badge badge-grey"><?= $com3['aa']?></span>
                    </a>
                    <script type="text/javascript">

                    </script>
                    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="icon-ok"></i>
                            还有<?= $com3['aa']?>个任务完成
                        </li>
                    <?php endforeach; ?> 
                        <?php foreach($com as $com1):?>
                        <li>
                         <?php /*用时间戳计算进度条*/
                                $start = strtotime($com1['m_creat_time']);
                                $end = strtotime($com1['m_endtime']);
                                $zong=ceil($end-$start); 
                                $yong=ceil((time()-$start)/($zong/100));
                                $width=ceil(($yong/$zong)*100);
                            
                                ?>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left"><?= $com1['m_name']?></span>
                                    <span class="pull-right"><?= $width?>%</span>
                                </div>
                                <div class="progress progress-mini ">                          
								  <div style="width:<?= $width?>%" class="progress-bar"></div>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; ?> 
                        <li>
                            <a href="<?= Url::toRoute(['mission/index'])?>">
                                查看任务详情
                                <i class="icon-arrow-right"></i>
                            </a>
                        </li>
                        
                    </ul>
                </li>
            
                <li class="purple">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-bell-alt icon-animated-bell"></i>
                        <span class="badge badge-important"><?php echo $com_shu?></span>
                    </a>
                   
                    <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="icon-warning-sign"></i>
                            <?php echo $com_shu?>条通知
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="btn btn-xs no-hover btn-pink icon-comment"></i>
                                                任务通知
                                            </span>
                                    <span class="pull-right badge badge-info">+<?php echo $com_shu?></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                查看所有通知
                                <i class="icon-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="green">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-envelope icon-animated-vertical"></i>
                        <span class="badge badge-success">5</span>
                    </a>

                    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="icon-envelope-alt"></i>
                            5条消息
                        </li>

                        <li>
                            <a href="#">
                                <img src="assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                                <span class="msg-body">
                                            <span class="msg-title">
                                                <span class="blue">Alex:</span>
                                                不知道写啥 ...
                                            </span>

                                            <span class="msg-time">
                                                <i class="icon-time"></i>
                                                <span>1分钟以前</span>
                                            </span>
                                        </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <img src="assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                <span class="msg-body">
                                            <span class="msg-title">
                                                <span class="blue">Susan:</span>
                                                不知道翻译...
                                            </span>

                                            <span class="msg-time">
                                                <i class="icon-time"></i>
                                                <span>20分钟以前</span>
                                            </span>
                                        </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <img src="assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                                <span class="msg-body">
                                            <span class="msg-title">
                                                <span class="blue">Bob:</span>
                                                到底是不是英文 ...
                                            </span>

                                            <span class="msg-time">
                                                <i class="icon-time"></i>
                                                <span>下午3:15</span>
                                            </span>
                                        </span>
                            </a>
                        </li>

                        <li>
                            <a href="inbox.html">
                                查看所有消息
                                <i class="icon-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
                        <span class="user-info">
                                    <small>欢迎您,</small>
                                    <?php $session = Yii::$app->session; $session->open(); echo $session->get('uname')?>
                                </span>

                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="icon-cog"></i>
                                设置
                            </a>
                        </li>

                         <li>
                            <a href="index.php?r=oauser/update&id=<?= $a?>">
                                <i class="icon-user"></i>
                                个人资料
                            </a>
                        </li>
                        <li>
                            <a href="index.php?r=oauser/upwd&id=<?= $a?>">
                                <i class="glyphicon glyphicon-star"></i>
                                修改密码
                            </a>
                        </li>
                        <li class="divider"></li>

                        <li>
                            <a href="<?=Url::toRoute(['login/loginout']);?>">
                                <i class="icon-off"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
    </div><!-- /.container -->
</div>

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
            </script>

            <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                    <button class="btn btn-success">
                        <i class="icon-signal"></i>
                    </button>

                    <button class="btn btn-info">
                        <i class="icon-pencil"></i>
                    </button>

                    <button class="btn btn-warning">
                        <i class="icon-group"></i>
                    </button>

                    <button class="btn btn-danger">
                        <i class="icon-cogs"></i>
                    </button>
                </div>

                <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span>

                    <span class="btn btn-info"></span>

                    <span class="btn btn-warning"></span>

                    <span class="btn btn-danger"></span>
                </div>
            </div><!-- #sidebar-shortcuts -->

            <ul class="nav nav-list">
                <li>
                    <a href="<?= Url::toRoute(['oaaffiche/index'])?>">
                        <i class="icon-bullhorn"></i>
                        <span class="menu-text"> 公告 </span>
                    </a>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle" id="dropdown">
                        <i class="icon-group"></i>
                        <span class="menu-text"> 用户管理 </span>

                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu" id="aa">

                                <li>
                                    <a href="<?= Url::toRoute(['role/index'])?>">
                                        <i class="icon-leaf"></i>
                                        角色管理
                                    </a>
                                </li>

                                <li>
                                    <a href="<?= Url::toRoute(['user/index'])?>">
                                        <i class="icon-leaf"></i>
                                        管理员
                                    </a>
                                </li>
                    </ul>
                </li>
                <script type="text/javascript">
                 $(function(){
                   // alert(window.location.search);
                   if((window.location.search == '?r=role%2Findex') || (window.location.search == '?r=user%2Findex'))
                    {
                        $("#aa").css("display","block");
                        $("#toggle").click(function(){ 
                             $("#aa").css("display","none");
                         });
                    }
                    if((window.location.search == '?r=mission%2Findex') || (window.location.search == '?r=publish%2Findex'))
                    {
                        $("#bb").css("display","block");
                        $("#dropdown").click(function(){ 
                            $("#bb").css("display","none");
                          });
                    }            
                 });
                </script>
                
                <li>
                    <a href="#" class="dropdown-toggle" id="toggle">
                        <i class="icon-list-alt"></i>
                        <span class="menu-text"> 任务管理 </span>

                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu" id="bb">
                        <li>
                            <a href="<?= Url::toRoute(['mission/index'])?>">
                                <i class="icon-leaf"></i>
                                申请任务
                            </a>
                        </li>

                        <li>
                            <a href="<?= Url::toRoute(['publish/index'])?>">
                                <i class="icon-leaf"></i>
                                发布任务
                            </a>
                        </li>

                        <!--                            </ul>-->
                        <!--                        </li>-->
                    </ul>
                </li>

                <li>
                    <a href="<?= Url::toRoute(['oaposition/index'])?>">
                        <i class="icon-credit-card"></i>
                        <span class="menu-text"> 职位管理 </span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::toRoute(['oaschool/index'])?>">
                        <i class="icon-flag"></i>
                        <span class="menu-text">校区管理</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::toRoute(['oadepartment/index'])?>">
                        <i class="icon-briefcase"></i>
                        <span class="menu-text">部门管理</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" id="toggle">
                        <i class="icon-desktop"></i>
                        <span class="menu-text"> 工作管理 </span>

                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu" id="bb">
                        <li>
                            <a href="<?= Url::toRoute(['oawork/index'])?>">
                                <i class="icon-leaf"></i>
                                课时管理
                            </a>
                        </li>
                    </ul>
                </li>
                <li >
                    <a href="<?= Url::toRoute(['oaschool/power'])?>">
                        <i class="icon-folder-open"></i>
                        <span class="menu-text">组织管理</span>
                    </a>
                </li>
            </ul><!-- /.nav-list -->

            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
            </div>

            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
            </script>
        </div>
        
        <div class="main-content">
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">

                        <?= $content?><!-- 右侧栏部位 -->
                        
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div><!-- /.main-content -->
        
        <div class="ace-settings-container" id="ace-settings-container">
            <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                <i class="icon-cog bigger-150"></i>
            </div>
            <div class="ace-settings-box" id="ace-settings-box">
                <div>
                    <div class="pull-left">
                        <select id="skin-colorpicker" class="hide">
                            <option data-skin="default" value="#438EB9">#438EB9</option>
                            <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                            <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                            <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                        </select>
                    </div>
                    <span>&nbsp; 选择皮肤</span>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                    <label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                    <label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                    <label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                    <label class="lbl" for="ace-settings-rtl">切换到左边</label>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                    <label class="lbl" for="ace-settings-add-container">
                        切换窄屏
                        <b></b>
                    </label>
                </div>
				
            </div>
        </div><!-- /#ace-settings-container -->
    </div><!-- /.main-container-inner -->
    <!--开始任务栏-->
    <?php foreach($com_s as $com_s1){?>
    <?php 
    $com_sx=explode(',',$com_s1['mlog_user']);
    $user=new OaUser;
    $arr=array();
    foreach($com_sx as $com_sx1){
        $aa=$user->find()->where(['oa_uid'=>$com_sx1])->one();
        $arr[]=$aa['oa_nickname'];
    }
    ?>
    <div style="width:300px;float:right;height:60px">
			   <div class="alert alert-warning">
			    <a href="#" class="close" data-dismiss="alert" name="<?= $com_s1['mlog_id']?>" onclick="return clos(this)">
			        &times;
			    </a>
			    <h4>任务开始通知</h4><span><?= date('Y-m-d H-i-s',$com_s1['mlog_creattime']).'由'.$com_s1['oaUser']['oa_nickname'].'开始任务指派给 '.$arr = implode(',',$arr); ?></span>
			   </div>
            </div>
    <?php }?>
    <!--完成任务栏-->
    <?php foreach($com_w as $com_w1){?>
    <?php 
    $com_wx=explode(',',$com_w1['mlog_user']);
    $user=new OaUser;
    $arr=array();
    foreach($com_wx as $com_wx1){
        $aa=$user->find()->where(['oa_uid'=>$com_wx1])->one();
        $arr[]=$aa['oa_nickname'];
    }
    ?>
    <div style="width:300px;float:right;height:60px">
               <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" name="<?= $com_w1['mlog_id']?>" onclick="return clos2(this)">
                    &times;
                </a>
                <h4>任务完成通知</h4><span><?= date('Y-m-d H-i-s',$com_w1['mlog_creattime']).'由 '.$arr = implode(',',$arr).' 完成'; ?></span>
               </div>
            </div>
    <?php }?>
    <script type="text/javascript">
    //查看开始任务通知修改状态
    function clos(obj){
         var clos = $(obj).attr('name');
         $.get("<?= Url::toRoute(['mission/status'])?>",{clos:clos});
     }
     //查看完成任务通知修改状态
    function clos2(obj){
         var clos2 = $(obj).attr('name');
         $.get("<?= Url::toRoute(['mission/status'])?>",{clos2:clos2});
     }
    </script>
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="icon-double-angle-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->

<!-- <![endif]-->

<!--[if IE]>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<!-- [endif]-->

<!--[if !IE]> -->

<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"script>");
</script>
<![endif]-->

<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/typeahead-bs2.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
<script src="assets/js/excanvas.min.js"></script>
<![endif]-->

<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
<script src="assets/js/jquery.sparkline.min.js"></script>
<script src="assets/js/flot/jquery.flot.min.js"></script>
<script src="assets/js/flot/jquery.flot.pie.min.js"></script>
<script src="assets/js/flot/jquery.flot.resize.min.js"></script>

<!-- ace scripts -->

<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->

<script type="text/javascript">
    jQuery(function($) {
        $('.easy-pie-chart.percentage').each(function(){
            var $box = $(this).closest('.infobox');
            var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
            var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
            var size = parseInt($(this).data('size')) || 50;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size/10),
                animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                size: size
            });
        })

        $('.sparkline').each(function(){
            var $box = $(this).closest('.infobox');
            var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
            $(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
        });




        var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
        var data = [
            { label: "social networks",  data: 38.7, color: "#68BC31"},
            { label: "search engines",  data: 24.5, color: "#2091CF"},
            { label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
            { label: "direct traffic",  data: 18.6, color: "#DA5430"},
            { label: "other",  data: 10, color: "#FEE074"}
        ]
        function drawPieChart(placeholder, data, position) {
            $.plot(placeholder, data, {
                series: {
                    pie: {
                        show: true,
                        tilt:0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: null,
                    margin:[-30,15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }
        drawPieChart(placeholder, data);

        /**
         we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
         so that's not needed actually.
         */
        placeholder.data('chart', data);
        placeholder.data('draw', drawPieChart);



        var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
        var previousPoint = null;

        placeholder.on('plothover', function (event, pos, item) {
            if(item) {
                if (previousPoint != item.seriesIndex) {
                    previousPoint = item.seriesIndex;
                    var tip = item.series['label'] + " : " + item.series['percent']+'%';
                    $tooltip.show().children(0).text(tip);
                }
                $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
            } else {
                $tooltip.hide();
                previousPoint = null;
            }

        });






        var d1 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d1.push([i, Math.sin(i)]);
        }

        var d2 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d2.push([i, Math.cos(i)]);
        }

        var d3 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.2) {
            d3.push([i, Math.tan(i)]);
        }


        var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
        $.plot("#sales-charts", [
            { label: "Domains", data: d1 },
            { label: "Hosting", data: d2 },
            { label: "Services", data: d3 }
        ], {
            hoverable: true,
            shadowSize: 0,
            series: {
                lines: { show: true },
                points: { show: true }
            },
            xaxis: {
                tickLength: 0
            },
            yaxis: {
                ticks: 10,
                min: -2,
                max: 2,
                tickDecimals: 3
            },
            grid: {
                backgroundColor: { colors: [ "#fff", "#fff" ] },
                borderWidth: 1,
                borderColor:'#555'
            }
        });


        $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('.tab-content')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }


        $('.dialogs,.comments').slimScroll({
            height: '300px'
        });


        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
            $('#tasks').on('touchstart', function(e){
                var li = $(e.target).closest('#tasks li');
                if(li.length == 0)return;
                var label = li.find('label.inline').get(0);
                if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
            });

        $('#tasks').sortable({
                opacity:0.8,
                revert:true,
                forceHelperSize:true,
                placeholder: 'draggable-placeholder',
                forcePlaceholderSize:true,
                tolerance:'pointer',
                stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                    $(ui.item).css('z-index', 'auto');
                }
            }
        );
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
            if(this.checked) $(this).closest('li').addClass('selected');
            else $(this).closest('li').removeClass('selected');
        });


    })
</script>
</body>
</html>
<?php $this->endPage() ?>