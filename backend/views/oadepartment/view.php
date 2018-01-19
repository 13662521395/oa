<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OaDepartment */

$this->title = $model->dep_id;
$this->params['breadcrumbs'][] = ['label' => 'Oa Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-department-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->dep_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->dep_id], [
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
            'dep_id',
            'dep_name',
            'dep_number',
            'dep_logo',
            'dep_syno',
            'dep_leader',
            'school_id',
            'dep_creattime',
            'dep_softdel',
        ],
    ]) ?>

</div>
