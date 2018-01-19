<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OaPublish */

$this->title = $model->p_id;
$this->params['breadcrumbs'][] = ['label' => 'Oa Publishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-publish-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->p_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->p_id], [
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
            'p_id',
            'p_name',
            'p_user',
            'p_fid',
            'p_content:ntext',
            'p_import',
            'p_create_time',
            'p_edit_time',
            'p_status',
        ],
    ]) ?>

</div>
