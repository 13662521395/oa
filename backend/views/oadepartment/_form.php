<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\Session;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\OaDepartment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-department-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dep_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dep_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dep_logo')->dropDownList(['1'=>'教学部','2'=>'学工部','3'=>'后勤部','4'=>'督查部','5'=>'市场部']) ?>

    <?= $form->field($model, 'dep_syno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oa_uid')->dropDownList(ArrayHelper::map($user,'oa_uid','oa_nickname')) ?>

    <?= $form->field($model, 'school_id')->dropDownList(ArrayHelper::map($school,'school_id','school_name')) ?>
    <?php $model->dep_softdel = '1'; ?>
    <?= $form->field($model, 'dep_softdel')->radioList(['1'=>'正常']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '确认添加' : '确认修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<script>
    $(function(){
      $('#oadepartment-dep_name').change(function(){
        $.get("<?=Url::toRoute('oadepartment/ajax')?>",{pos:$(this).val()},function(data){
            // alert(data);
            $("#oadepartment-dep_logo").val(data);
        });
      });
    });
    
    </script>
    <?php ActiveForm::end(); ?>

</div>
