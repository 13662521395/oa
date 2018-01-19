<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\OaUser;

/* @var $this yii\web\View */
/* @var $model app\models\OaMission */

date_default_timezone_set("Asia/Shanghai");

$this->title = '申请任务';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="assets/kindeditor/examples/index.css" />
<script charset="utf-8" src="assets/kindeditor/kindeditor.js"></script>
<script>
    KE.show({
        id : 'content',
    });
</script>
<div class="oa-mission-create">

    <div class="oa-mission-index">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <ol class="breadcrumb">
                <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">首页</a></li>
                <li><a href="<?= Url::toRoute(['mission/index'])?>">任务</a></li>
                <li>申请</li>
            </ol>
        </div>

        <div class="oa-mission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'm_name')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'm_user')->dropDownList(OaUser::find()->select('oa_uname')->indexBy('oa_uid')->column(),['prompt'=>'- - 请选择用户 - -']) ?> -->
    
    <?= $form->field($model, 'm_user')->textInput(['placeholder'=>$data->oa_nickname,'readonly'=>true]) ?>

     <div>任务详情</div>
     <textarea name="content" style="width:100%;visibility: hidden;"></textarea>

    <?= $form->field($model, 'm_import')->dropdownList(['1'=>'普通','2'=>'紧急','3'=>'非常紧急'],['prompt'=>'- - 请确定任务优先级 - -']) ?>
    
    <?= $form->field($model, 'm_estima')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'm_creat_time')->textInput(['value'=> date('Y-m-d',time()),'readonly'=>'true']) ?>

	<!-- 手动选择申请时间 -->
    <!-- <input type="date" name="create" value="<?= date('Y-m-d',time()) ?>" /> -->

    <!-- 手动选择修改时间 -->
    <?= $form->field($model, 'm_edit_time')->textInput(['readonly'=>true]) ?>
    <p>截至时间</p>
    <input type="date" name="endtime" style="width:100%"/>

<!-- <?//= $form->field($model, 'm_big_check')->dropDownList(['0'=>'未审核','1'=>'已审核','2'=>'未通过'],['prompt'=>'- - 请选择 - -']) ?>

 <?//= $form->field($model, 'm_biger_check')->dropDownList(['0'=>'未审核','1'=>'已审核','2'=>'未通过'],['prompt'=>'- - 请选择 - -']) ?>-->

    <!-- <?= $form->field($model, 'm_big_command')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'm_biger_command')->textInput(['maxlength' => true,'readonly'=>true]) ?> -->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '申请' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
