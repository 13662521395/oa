<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\Session;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\OaPosition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-position-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pos_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pos_rank')->textInput() ?>
    
    <?= $form->field($model, 'pos_grade')->textInput() ?>

    <?= $form->field($model, 'pos_fid')->dropDownList(['prompt' => "--请选择--"
,'0'=>'无','1'=>'主任','2'=>'副主任','3'=>'部门主任'])  ?>

    <?= $form->field($model, 'pos_status')->radioList(['0'=>'是','1'=>'否']) ?>

    <?= $form->field($model, 'dep_id')->dropDownList(ArrayHelper::map($oadepartment,'dep_id','dep_name'),['prompt' => "--请选择--"]) ?>

    <?= $form->field($model, 'school_id')->dropDownList(ArrayHelper::map($oaposition,'school_id','school_name'),['prompt' => "--请选择--"]) ?>
    <?php $model->pos_softdel = '1'; ?>
    <?= $form->field($model, 'pos_softdel')->radioList(['1'=>'正常']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '确认添加' : '确认修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
