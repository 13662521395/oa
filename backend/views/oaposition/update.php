<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\OaPosition */

$this->title = '山东柏瑞管理系统-修改';
$this->params['breadcrumbs'][] = ['label' => 'Oa Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pos_id, 'url' => ['view', 'id' => $model->pos_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ol class="breadcrumb">
                  <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">首页</a></li>
                  <li><a href="<?= Url::toRoute(['oaposition/index'])?>">组织</a></li>
                  <li>修改</li>
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
<div class="oa-position-update">

    <?= $this->render('_form', [
        'model' => $model,
        'oaposition'=>$oaposition,
        'oadepartment'=>$oadepartment,
    ]) ?>

</div>
