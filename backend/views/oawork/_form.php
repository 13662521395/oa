<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OaWork */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-work-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'w_teacher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'w_subjects')->radioList(['1'=>'语文','2'=>'数学','3'=>'英语','4'=>'编程','5'=>'美工',]) ?>

    <?= $form->field($model, 'w_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'w_fees')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'w_time')->textInput(['maxlength' => true,'type'=>'date']) ?>

    <?php $model->w_status = '1'; ?>
    
    <?= $form->field($model, 'w_status')->radioList(['1'=>'正常']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '确认' : '确认', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
