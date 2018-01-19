<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Oauser */

$this->title = '添加用户';
$this->params['breadcrumbs'][] = ['label' => 'Oausers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dep'=>$dep,
        'pos'=>$pos,
        'school'=>$school,
    ]) ?>

</div>
