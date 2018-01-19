<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OaRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role_name')->textInput(['maxlength' => true,'placeholder'=>'请输入角色名称']) ?>



    <?= $form->field($model, 'remark')->textarea(['rows'=>5]) ?>


    <?= $form->field($model, 'status')->radioList(['0'=>'禁用','1'=>'正常']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加角色' : '编辑角色', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => "border-radius: 10px"]) ?>
    </div>

    <button class="btn" style="border-radius: 10px" type="reset">
        <i class="icon-undo bigger-110"></i>
        重置
    </button>
	<a class="btn" style="border-radius: 10px" href="index.php?r=role/index">
        <i class="icon-remove bigger-110"></i>
        返回
    </a>
    <?php ActiveForm::end(); ?>

</div>
