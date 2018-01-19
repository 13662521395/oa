<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OaRacord */

$this->title = 'Update Oa Racord: ' . $model->racord_id;
$this->params['breadcrumbs'][] = ['label' => 'Oa Racords', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->racord_id, 'url' => ['view', 'id' => $model->racord_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="oa-racord-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
