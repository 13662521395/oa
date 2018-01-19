<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Oauser */
/* @var $form yii\widgets\ActiveForm */


$this->params['breadcrumbs'][] = ['label' => 'Oa Affiches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oa_uid, 'url' => ['view', 'id' => $model->oa_uid]];

?>

<div class="oa-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_fo', [
        'model' => $model,
        'dep'=>$dep,
        'pos'=>$pos,
        'school'=>$school,
    ]) ?>

</div>