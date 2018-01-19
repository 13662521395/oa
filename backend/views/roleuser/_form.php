<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OaRoleUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-role-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_pass')->passwordInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_id')->radioList(['1'=>'角色1','2'=>'角色2']) ?>

    <?= $form->field($model, 'status')->radioList(['0'=>'禁用','1'=>'正常']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<button class="btn" type="reset">
        <i class="icon-undo bigger-110"></i>
        重置
    </button>
    <a class="btn" href="index.php?r=role/index">
        <i class="icon-remove bigger-110"></i>
        返回
    </a>
    <?php ActiveForm::end(); ?>

</div>
