<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = '管理员';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ol class="breadcrumb">
                  <li><a href="#">首页</a>
                  <li><a href="#">管理员</a>
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

<div class="oa-role-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('管理员添加', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="col-xs-12">
    <div class="table-responsive">
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="col-xs-1">ID</th>
                    <th class="col-xs-1">用户名</th>
                    <th class="hidden-480 col-xs-2">最后登录IP</th>
                    <th class="hidden-480 col-xs-2">
                        <i class="icon-time bigger-110 hidden-480"></i>
                        最后登录时间</th>
                    <th class="col-xs-2">邮箱</th>
                    <th class="hidden-480 col-xs-1">状态</th>
                    <th class="col-xs-2">操作</th>
                </tr>
            </thead>

            <tbody>
            <?php 
        foreach($query as $v)
        {
       ?>
                <tr>
                    <td><?php echo $v['user_id'];?></td>  
                    <td><?php echo $v['user_name'];?></td>
                    <td class="hidden-480"><?php echo $v['last_ip'];?></td>
                    <td class="hidden-480"><?php echo $v['last_time'];?></td>
                    <td class="hidden-480"><?php echo $v['mail'];?></td>
                    <td class="hidden-480">
                    <?php if($v['status']==0):?>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    <?php elseif ($v['status']==1):?>
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    <?php endif?>  
                        
                    </td>

                    <td>
                        <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                            <!--<button class="btn btn-xs btn-success">
                                <i class="icon-ok bigger-120"></i>
                            </button>-->
                            <a class="btn btn-xs btn-info" href="index.php?r=roleuser/update&id=<?=$v['user_id'];?>">
                                <i class="icon-edit bigger-120"></i>编辑
                            </a>

                            <a class="btn btn-xs btn-danger" href="index.php?r=roleuser/delete&id=<?=$v['user_id'];?>"  onClick="return confirm('确认要删除用户：<?=$v['user_name'];?> ？')">
                                <i class="icon-trash bigger-120"></i>删除
                            </a>

                            <a class="btn btn-xs btn-inverse" href="index.php?r=roleuser/status&id=<?=$v['user_id'];?>" onClick="return confirm('确认要将用户：<?=$v['user_name'];?> 拉黑？')">
                                <i class="icon-remove bigger-120"></i>拉黑
                            </a>

                        </div>

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
                                    </div>
</div>
