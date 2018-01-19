<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OaRacord */

$this->title = $model->racord_id;
$this->params['breadcrumbs'][] = ['label' => 'Oa Racords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-racord-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->racord_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->racord_id], [
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
            'racord_id',
            'racord_name',
            'racord_user',
            'racord_time',
        ],
    ]) ?>

</div>
