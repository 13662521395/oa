<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OaRacord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-racord-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'racord_id')->textInput() ?>

    <?= $form->field($model, 'racord_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'racord_user')->textInput() ?>

    <?= $form->field($model, 'racord_time')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
