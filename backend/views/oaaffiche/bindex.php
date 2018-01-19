<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\filters\PageCache;
use backend\models\Building;
use backend\models\User;
use backend\models\Type;
use yii\widgets\LinkPager;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '山东柏瑞管理系统-我接收的公告';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    公告详情
                </h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<div class="modal fade" id="myModalds" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header" >
      <h1>温馨提示</h1>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
      </div>
      <div class="modal-bodyds" style="margin-left:25px">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">关闭
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div><!-- /.modal --> 
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ol class="breadcrumb">
        <li><a href="#">首页</a>
        <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">公告</a>
        <li><a href="#">我接收的公告</a>
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

<div class="row" style="margin-top: 10px">
    <div class="col-lg-12">
        <ul id="myTab" class="nav nav-tabs">
            <li>
                <a href="<?= Url::toRoute('oaaffiche/dindex'); ?>" >
                    我发布的公告
                </a>
            </li>
            <li  class="active"><a href="#" >我接收的公告</a></li>
        </ul>
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-sm-12">
        <form id="admin-user-search-form" class="form-inline" action="index.php" method="get">
            <input type="hidden" name="r" value="oaaffiche/bindex">
            <div class="form-group" style="margin: 5px;">

                <label>类型</label>
                <select name="list" id="list" class="form-control">
                    <option value="">--请选择--</option>
                    <option value="1">全员公告</option>
                    <option value="2">指定公告</option>
                    <?php if($sess['pos_id' ]< 3):?>
                        <option value="3">领导公告</option>

                    <?php endif?>
                </select>
                <div class="form-group"  style="margin-top: 5px">
                    <button type="submit" name="submit"    class="btn btn-primary btn-sm" style="border-radius: 10px">搜索</button>
                </div>
        </form>
    </div>
</div>
<div class="col-sm-12 col-xs-12 widget-container-span">

    <div class="widget-body" style="border:none">
        <div class="widget-main padding-12 no-padding-left no-padding-right">
            <div class="tab-content padding-4">
                <div id="home2" class="tab-pane in active">
                    <div class="slim-scroll" data-height="100">

                        <div class="row">
                            <div class="col-xs-12">

                                <div class="table-responsive">
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                        <th>序号</th>
                                        <th>公告标题</th>
                                        <th>公告内容</th>
                                        <th>发布人员</th>
                                        <th>发布类型</th>
                                        <th>操作  <!-- <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button> --></th>
                                    </tr>
                                    </thead>
            <tbody>
            <?php
            /*序号计算*/
            $a=yii::$app->request->get('page')?yii::$app->request->get('page'):1;
            $i=$pagesize*($a-1)+1;
            ?>
            <?php foreach($models as $ke):?>
                <tr id="rowid_1">
                    <td><?= $i++ ?></td>
                    <td><?= $ke['oaaffiche']['aff_title']?></td>
                    <td><?= $ke['oaaffiche']['aff_content']?></td>
                    <td><?= $ke['oauser']['oa_nickname']?></td>
                    <?php if($ke->aff_pos == 1):?>
                        <td style="color:blur" class="quan">全员公告</td>
                    <?php endif?>
                    <?php if($ke->aff_pos == 2):?>
                        <td style="color:yelower" class="zhi">指定部门公告</td>
                    <?php endif?>
                    <?php if($ke->aff_pos == 3):?>
                        <td style="color:yelower" class="zhi">领导公告</td>
                    <?php endif?>
                    <td>

                        <a class="btn btn-xs btn-success" style="border-radius: 10px; border" href='index.php?r=oaaffiche/view&id=<?= $ke['oaaffiche']['aff_id']?>'>
                            <i class="icon-ok bigger-120" data-toggle="modal" data-target="#myModal" onclick="return fun1(this)" >查看</i></a>
							 
                    </td>
                </tr>
            <?php endforeach; ?>
            <script type="text/javascript">
                $(function(){
                    //alert($(".public").text());
                    var str='';
                    $(".quan").each(function(){  //遍历所有的name为id[]的 checkbox
                        str+='.'+$(this).val(); //+连接
                    });
                    // alert(str);
                    //str=str.substr(1);

                    $.get("<?=Url::toRoute('oaaffiche/ajax3')?>",{str:$(this).val()},function(data){
                        //alert(data);
                    });
                });
            </script>
            </tbody>
        </table>
        <div class="infos" style="float:right">
            <?= LinkPager::widget([
                'pagination' => $pages,
                'nextPageLabel' => '下一页',
                'prevPageLabel' => '上一页',
                'firstPageLabel' => '首页',
                'lastPageLabel' => '尾页',
            ]);?>
        </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="profile2" class="tab-pane">
                    <div class="slim-scroll" data-height="100">
                        <p class="alert alert-info"></p>
                    </div>
                </div>

                <div id="info2" class="tab-pane">
                    <div class="slim-scroll" data-height="100">
                        <p class="alert alert-info"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function fun1(obj)
    {
        var a=$(obj).attr('name');
        
        $.get("<?= Url::toRoute(['oaaffiche/ajax1'])?>",{a:a},function(date)
        {
            var str = eval("("+date+")");
           $(".modal-body").html('<tr><td>公告标题：'+str['aff_title']+'</td></tr><tr><td>公告内容：'+str['aff_content']+'</td></tr><tr><td>发布人员：'+str['oa_uid']+'</td></tr><tr><td>发布类型：'+str['aff_pos']+'</td></tr>)
        })
        return false;
    }
</script>
