<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Oauser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oauser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oa_uname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oa_nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oa_sex')->radioList([1=>'男',2=>'女']) ?>

    <?= $form->field($model, 'oa_utel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oa_pwd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'school_id')->dropDownList(ArrayHelper::map($school,'school_id','school_name'),['prompt' => "--请选择--"]);?>

    <?= $form->field($model,'pos_id')->dropDownList([]);?>

    <?= $form->field($model,'dep_id')->dropDownList([]);?>
    <script type="text/javascript">
    $(function(){
       
        $('#oauser-school_id').change(function(){
        var op=$("#oauser-school_id option:selected").val();
         /*根据校区选部门*/
        $.get("<?=Url::toRoute('oauser/ajax')?>",{op:op},function(data){    
                   //alert(data);   
                     $("#oauser-dep_id").html(data);
                     });
        /*根据部门选职位*/
        $.get("<?=Url::toRoute('oauser/ajax1')?>",{op:op},function(data){    
                   //alert(data);   
                     $("#oauser-pos_id").html(data);
                     });
        });
        
         /*根据部门选人员*/
        $('#oauser-dep_id').change(function(){
        var op=$("#oauser-dep_id option:selected").val();
        $.get("<?=Url::toRoute('oauser/ajax2')?>",{op:op},function(data){    
                    //alert(data);   
                    $("#power").html(data);
                     });
      })
    })
    </script>
    <div class="form-group field-oauser-duty_id">
    <label class="control-label" for="oauser-duty_id">所拥有的部门权限</label>
    <div id="power"></div>
    <div class="help-block"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' :'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= HTML::a('返回',['sindex'],['class'=>'btn btn-success']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
