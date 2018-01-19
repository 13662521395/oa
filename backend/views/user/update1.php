<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OaUser */

$this->title = '山东柏瑞科技有限公司-管理员修改' . $model->oa_uid;
$this->params['breadcrumbs'][] = ['label' => 'Oa Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oa_uid, 'url' => ['view', 'id' => $model->oa_uid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ol class="breadcrumb">
      <li><a href="index.php?r=oaaffiche/index">首页</a>
      <li><a href="index.php?r=user/index">管理员</a>
      <li><a href="#">管理员编辑</a>
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
<div class="oa-user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
