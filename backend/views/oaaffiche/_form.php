<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\OaAffiche */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-affiche-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aff_title')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'aff_content')->textarea(['rows' => 6]) ?>
     
    <?= $form->field($model, 'oa_uid')->dropDownList(ArrayHelper::map($user,'oa_uid','oa_nickname'));?>
   
    <div class="form-group field-oaaffiche-aff_pos required">
    <label class="control-label">公告类型</label>
    <input type="hidden" name="Oaaffiche[aff_pos]" value=""><div id="oaaffiche-aff_pos" aria-required="true">
    <?php if($dep->pos_id < 3):?><!--普通老师无法查看全员-->
        <label><input type="radio" name="Oaaffiche[aff_pos]" id="qpos" value="1"> 全员公告</label>
    <?php endif?>

        <label><input type="radio" name="Oaaffiche[aff_pos]" id="pos" value="2"> 指定公告</label>

    <?php if($dep->pos_id < 3):?><!--领导才能发布领导公告-->
        <label><input type="radio" name="Oaaffiche[aff_pos]" id="lpos" value="3">领导公告</label>
    <?php endif?>
    </div>

    <div class="help-block"></div>
    </div>     
     
    <script type="text/javascript">
    $(function(){
        $('#qpos').change(function(){
        $.get("<?=Url::toRoute('oaaffiche/ajax')?>",{qpos:$(this).val()},function(data){    
                    //alert(data);   
                    $("#aa").html(data);
                    
            });
      })

      $('#pos').change(function(){
        $.get("<?=Url::toRoute('oaaffiche/ajax2')?>",{pos:$(this).val()},function(data){    
                    //alert(data);   
                    $("#aa").html(data);
                     });
      })
      $('#aa').change(function(){
         var str='';
        $("input[name='Oaaffiche[aff_publication][]']:checked").each(function(){  //遍历所有的name为id[]的 checkbox
            str+=','+$(this).val(); //+连接
        });
        str=str.substr(1);
        $.get("<?=Url::toRoute('oaaffiche/ajax3')?>",{str:str},function(data){    
                    //alert(data);   
                    $("#bb").html(data);
                     });
      })
       $('#lpos').change(function(){
        $.get("<?=Url::toRoute('oaaffiche/ajax4')?>",{lpos:$(this).val()},function(data){    
                    //alert(data);   
                    $("#aa").html(data);
                     });
      })
    })
    </script>
    
    <div class="form-group field-oaaffiche-aff_publication">
    <label class="control-label" for="oaaffiche-aff_publication">发布对象</label>
    <div id="aa"></div>
    <div id="bb"></div>
    <div class="help-block"></div>
        <?= $form->field($model, 'aff_creattime')->textInput(['type'=>'date']) ?>
    </div> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','style'=>'border-radius: 10px']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>