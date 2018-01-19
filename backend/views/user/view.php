<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OaUser */

$this->title = $model->oa_uid;
$this->params['breadcrumbs'][] = ['label' => 'Oa Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->oa_uid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->oa_uid], [
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
            'oa_uid',
            'oa_uname',
            'oa_nickname',
            'oa_card',
            'oa_sex',
            'oa_age',
            'oa_utel',
            'oa_pwd',
            'oa_emil',
            'oa_standing',
            'dep_id',
            'pos_id',
            'school_id',
            'duty_id',
            'oa_auth',
            'oa_ucreattime',
            'oa_status',
            'role_id',
        ],
    ]) ?>

</div>
