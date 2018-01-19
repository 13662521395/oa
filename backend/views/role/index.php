<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ol class="breadcrumb">
      <li><a href="index.php?r=oaaffiche/index">首页</a>
      <li><a href="#">角色管理</a>
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
<div>            
<?php  if( Yii::$app->getSession()->hasFlash('success') ) {
                        echo Alert::widget([
                        'options' => [
                        'class' => 'alert-success', //这里是提示框的class
                        ],
                        'body' => Yii::$app->getSession()->getFlash('success'), //消息体
                        ]);
                    }
                    if( Yii::$app->getSession()->hasFlash('error') ) {
                        echo Alert::widget([
                        'options' => [
                        'class' => 'alert-error',
                        ],
                        'body' => Yii::$app->getSession()->getFlash('error'),
                        ]);
              } ?>
</div>
<div class="oa-role-index">
<p> </p>
    <p>
        <?= Html::a('添加角色', ['create'], ['class' => 'btn btn-success', 'style' => "border-radius: 10px"]) ?>
    </p>
<div class="col-xs-12">
    <div class="table-responsive">
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="col-xs-1">ID</th>
                    <th class="col-xs-1">角色名称</th>
                    <th class="hidden-480 col-xs-5">角色描述</th>
                    <th class="hidden-480 col-xs-1">
                        <i class="icon-time bigger-110 hidden-480"></i>
                        状态</th>
                    <th class="col-xs-2">操作</th>
                </tr>
            </thead>

            <tbody>
            <?php 
        foreach($query as $v)
        {
       ?>
                <tr>
                    <td><?php echo $v['role_id'];?></td>  
                    <td><?php echo $v['role_name'];?></td>
                    <td class="hidden-480"><?php echo $v['remark'];?></td>
                    <td class="hidden-480">
                    <?php if($v['status']==0):?>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    <?php elseif ($v['status']==1):?>
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    <?php endif?>  
                        
                        
                    </td>

                    <td>
                            <!--<button class="btn btn-xs btn-success">
                                <i class="icon-ok bigger-120"></i>
                            </button>-->

                            <a class="btn btn-xs btn-warning" style="border-radius: 10px" href="index.php?r=role/power&id=<?=$v->role_id;?>">
                                <i class="icon-flag bigger-120"></i>权限设置
                            </a>

                            <a class="btn btn-xs btn-info" style="border-radius: 10px" href="index.php?r=role/update&id=<?=$v->role_id;?>">
                                <i class="icon-edit bigger-120"></i>编辑
                            </a>

                            <a class="btn btn-xs btn-danger" style="border-radius: 10px" href="index.php?r=role/delete&id=<?=$v->role_id;?>" onClick="return confirm('确认要将用户：<?=$v['role_name'];?> 删除？')">
                                <i class="icon-trash bigger-120"></i>删除
                            </a>

                            <a class="btn btn-xs btn-inverse" style="border-radius: 10px" href="index.php?r=role/status&id=<?=$v['role_id'];?>" onClick="return confirm('确认要将用户：<?=$v['role_name'];?> 拉黑？')">
                                <i class="icon-remove bigger-120"></i>拉黑
                            </a>


                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-cog icon-only bigger-110"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="#" class="tooltip-info" data-rel="tooltip" title="" data-original-title="View">
                                            <span class="blue">
                                                <i class="icon-zoom-in bigger-120"></i>
                                            </span>
                                        </a>
                                                                        </li>

                                    <li>
                                        <a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
                                            <span class="green">
                                                <i class="icon-edit bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
                                            <span class="red">
                                                <i class="icon-trash bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div><!-- /.table-responsive -->
</div></div>
