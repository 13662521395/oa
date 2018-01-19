<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '山东柏瑞管理系统-结构组织';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
  </head>

  <body>
   
<div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ol class="breadcrumb">
                  <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">首页</a></li>
                  <li>结构组织图</li>
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
                <div class="row">
                  <div class="col-sm-11">
                      

                      <div class="widget-body">
                        <div class="widget-main padding-8">
                          <div id="tree1">
                          </div>
                      </div>
                    </div>
                  </div>
                </div>

<script>
 $(function(){
$.get('index.php?r=oaschool/powers',function(data){
  $("#tree1").html(data);
  $("#tree1 ul:first").attr("id","tree");
  $("#tree").treeview();
})
 });         
</script>

  
</body>
</html>