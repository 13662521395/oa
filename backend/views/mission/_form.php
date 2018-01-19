<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OaMission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-mission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'm_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'm_type')->textInput() ?>

    <?= $form->field($model, 'm_user')->textInput() ?>

    <?= $form->field($model, 'm_content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'm_import')->textInput() ?>

    <?= $form->field($model, 'm_lv')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'm_creat_time')->textInput() ?>

    <?= $form->field($model, 'm_edit_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
