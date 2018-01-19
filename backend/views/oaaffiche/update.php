<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OaAffiche */

$this->title = 'Update Oa Affiche: ' . $model->aff_id;
$this->params['breadcrumbs'][] = ['label' => 'Oa Affiches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aff_id, 'url' => ['view', 'id' => $model->aff_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="oa-affiche-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
