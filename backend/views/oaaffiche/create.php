<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OaAffiche */


$this->params['breadcrumbs'][] = ['label' => 'Oa Affiches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ol class="breadcrumb">
        <li><a href="#">首页</a>
        <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">公告</a>
        <li><a href="<?= Url::toRoute(['oaaffiche/dindex'])?>">我发布的公告</a>
        <li><a href="#">发布公告</a>
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

<div class="oa-affiche-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user'=>$user,
        'dep'=>$dep,
    ]) ?>

</div>
