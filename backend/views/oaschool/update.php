<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\OaSchool */

$this->title = '山东柏瑞管理系统-校区修改';
$this->params['breadcrumbs'][] = ['label' => 'Oa Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->school_id, 'url' => ['view', 'id' => $model->school_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ol class="breadcrumb">
                  <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">首页</a></li>
                  <li><a href="<?= Url::toRoute(['oaschool/index'])?>">校区</a></li>
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
<div class="oa-school-update">

    <?= $this->render('_form', [
        'model' => $model,
        'a'=>$a,
    ]) ?>

</div>
