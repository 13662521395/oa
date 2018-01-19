<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OaWork */

$this->title = $model->w_id;
$this->params['breadcrumbs'][] = ['label' => 'Oa Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-work-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->w_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->w_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'w_id',
            'w_teacher',
            'w_time',
            'w_subjects',
            'w_number',
            'w_fees',
            'w_status',
        ],
    ]) ?>

</div>
