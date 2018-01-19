<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\OaUser;

/* @var $this yii\web\View */
/* @var $model app\models\OaMission */

date_default_timezone_set("Asia/Shanghai");

$this->title = '发布任务';
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
                <li><a href="<?= Url::toRoute(['publish/index'])?>">任务</a></li>
                <li>发布</a></li>
            </ol>
        </div>


        <div class="oa-mission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'p_name')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'p_user')->dropDownList(OaUser::find()->select('oa_uname')->indexBy('oa_uid')->column(),['prompt'=>'- - 请选择用户 - -']) ?> -->

    <?= $form->field($model, 'p_user')->textInput(['placeholder'=>$data->oa_nickname,'readonly'=>true]) ?>

    <?= $form->field($model, 'p_users')->dropDownList(OaUser::find()->select('oa_uname')->indexBy('oa_uid')->column(),['prompt'=>'- - 指派给 - -']) ?>

     <div>任务详情</div>
     <textarea name="content" style="width:100%;visibility: hidden;"></textarea>

    <?= $form->field($model, 'p_import')->dropdownList(['1'=>'普通','2'=>'紧急','3'=>'非常紧急'],['prompt'=>'- - 请确定任务优先级 - -']) ?>

    <?= $form->field($model, 'p_create_time')->textInput(['value'=> date('Y-m-d H:i:s',time()),'readonly'=>'true']) ?>

	<!-- 手动选择申请时间 -->
    <!-- <input type="date" name="create" value="<?= date('Y-m-d',time()) ?>" /> -->

    <!-- 手动选择修改时间 -->
    <?= $form->field($model, 'p_edit_time')->textInput(['readonly'=>true]) ?>
    <p>截止时间</p>
    <input type="date" name="endtime"  style="width:100%"/>

<!-- <?//= $form->field($model, 'm_big_check')->dropDownList(['0'=>'未审核','1'=>'已审核','2'=>'未通过'],['prompt'=>'- - 请选择 - -']) ?>

 <?//= $form->field($model, 'm_biger_check')->dropDownList(['0'=>'未审核','1'=>'已审核','2'=>'未通过'],['prompt'=>'- - 请选择 - -']) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '发布' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
