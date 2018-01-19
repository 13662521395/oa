<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OaRoleUser */

// $this->title = '修改管理员: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Oa Role Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ol class="breadcrumb">
                  <li><a href="#">首页</a>
                  <li><a href="index.php?r=roleuser/index">管理员</a>
                  <li><a href="#">编辑管理员:<?php echo "$model->user_name" ?></a>
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

<div class="oa-role-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
