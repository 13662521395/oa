<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\filters\PageCache;
use app\models\OaUser;
use yii\widgets\LinkPager;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '山东柏瑞管理系统-公告';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ol class="breadcrumb">
        <li><a href="#">首页</a>
        <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">公告</a>
    </ol>

    <div class="nav-search" id="nav-search">
        <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="icon-search nav-search-icon"></i>
                                </span>
        </form>
    </div><!-- 面包屑导航 -->
</div>

<div >
    <div class="col-sm-8">
        <div class="row">
            <div class="col-xs-12">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat">
                        <h4 class="smaller">最新公告</h4>

                        <div class="widget-toolbar">
                            <label onclick="return fun(this)">
                                <small class="green">
                                    <b>阅读状态</b>
                                </small><span><?php if($model2['aff_rstate'] == 1){echo '未读'; }else{echo '已读';}?></span>
                            </label>
                        </div>
                    </div>

                    <div class="widget-body1" style="border:1px solid #ccc">
                        <div class="widget-main">
                            <dl id="dt-list-1">
                                <dt>标题：<?= $model2['aff_title'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    发布人：<?= $model2['oaUser']['oa_nickname']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    发布时间：<?= $model2['aff_creattime'];?> </dt>
                                <p>&nbsp;</p>
                                <dt>公告内容:</dt>
                                <dd><?= $model2['aff_content'];?> </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--最新公告-->
        <div id="box">
            <div class="col-sm-6">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat">
                        <h4>近期公告  </h4>
                        <span  style="float: right;color: #566676;padding: 8px"><a href="<?= Url::toRoute('oaaffiche/bindex'); ?>">更多</a></span>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul>
                                        <?php foreach($model as $ke):?>
                                            <li><a style="color:#666" href="index.php?r=oaaffiche/view&id=<?= $ke->aff_id?>"><?= $ke->aff_title?></a>
                                                <span style="float:right"><?= $ke->aff_creattime?></span></li>
                                        <?php endforeach; ?>
                                        <li style="list-style: none; font-size: 18px">
                                            <a href="<?= Url::toRoute('oaaffiche/bindex'); ?>">» » » » » »</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div><!--接收的公告栏-->
        <div class="col-sm-6">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4>我发布的公告  </h4>
                    <span  style="float: right;color: #566676;padding: 8px"><a href="<?= Url::toRoute('oaaffiche/dindex'); ?>">更多</a></span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul>
                                    <?php foreach($models as $ke):?>
                                        <li><a style="color:#666" href="index.php?r=oaaffiche/view&id=<?= $ke->aff_id?>"><?= $ke->aff_title?></a><span style="float:right"><?= $ke->aff_creattime?></span></li>
                                    <?php endforeach; ?>
                                    <li style="list-style: none; font-size: 18px">
                                        <a href="<?= Url::toRoute('oaaffiche/dindex'); ?>">» » » » » »</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--我发布的公告栏-->
    </div><!-- /span -->

    <!--阅读状态按钮-->
    <script>
        function fun(obj){
            var val = $(obj).children("span").html();
            if(val=='已读'){
                $(obj).children("span").html("未读");
            }else{
                $(obj).children("span").html("已读");
            }
        }
        $(function () {
           // ;
           <?php if($model2['aff_rstate'] == 1){ ?>
                              $(".widget-body1").show(); 
                            <?php }else{ ?>
                                $(".widget-body1").hide();
                          <?php  }?>
            $(".widget-toolbar").click(function () {
                $(".widget-body1").toggle("sole");
                $.get("<?= Url::toRoute('oaaffiche/toggle');?>",function(data)
                {
                    
                })
            })
        })
    </script>
</div>




