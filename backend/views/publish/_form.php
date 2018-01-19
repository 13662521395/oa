<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OaPublish */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-publish-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'p_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_user')->textInput() ?>

    <?= $form->field($model, 'p_fid')->textInput() ?>

    <?= $form->field($model, 'p_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'p_import')->textInput() ?>

    <?= $form->field($model, 'p_create_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_edit_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
