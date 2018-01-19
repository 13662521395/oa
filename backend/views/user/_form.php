<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\OaUser;
use backend\models\OaRole;
$query1 = OaRole::find()->asarray()->all();
/* @var $this yii\web\View */
/* @var $model app\models\OaUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oa_uname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oa_pwd')->passwordInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'oa_emil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_id')->radioList(['1'=>'角色1','2'=>'角色2']) ?>

    <?= $form->field($model, 'oa_status')->radioList(['0'=>'禁用','1'=>'正常']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => "border-radius: 10px"]) ?>
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
