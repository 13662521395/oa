<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\Session;
/* @var $this yii\web\View */
/* @var $model app\models\OaSchool */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-school-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'school_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'school_number')->textInput(['maxlength' => true,'value'=>'SDBR']) ?>

    <?= $form->field($model, 'school_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'school_syno')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'school_leader')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'school_addper')->textInput(['maxlength' => true,'value'=>$a,'readOnly'=>true]) ?>
    <?php $model->school_softdel = '1'; ?>
    <?= $form->field($model, 'school_softdel')->radioList(['1'=>'正常']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '确认添加' : '确认修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
