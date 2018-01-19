<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OaRole */

$this->title = '添加角色';
$this->params['breadcrumbs'][] = ['label' => 'Oa Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ol class="breadcrumb">
      <li><a href="#">首页</a>
      <li><a href="index.php?r=role/index">角色管理</a>
      <li><a href="#">添加角色</a>
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

<div class="oa-role-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>