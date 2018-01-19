<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\OaUser;

date_default_timezone_set("Asia/Shanghai");
/* @var $this yii\web\View */
/* @var $model app\models\OaMission */

$this->title = '修改子任务';
$this->params['breadcrumbs'][] = $this->title;
//$User = OaUser::findOne($model->m_user);
?>
<link rel="stylesheet" href="assets/kindeditor/examples/index.css" />
<script charset="utf-8" src="assets/kindeditor/kindeditor.js"></script>
<script>
    KE.show({
        id : 'content',
    });
</script>

<div class="oa-mission-update">

    <div class="oa-mission-index">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <ol class="breadcrumb">
                <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">首页</a></li>
                <li><a href="<?= Url::toRoute(['mission/index'])?>">任务</a></li>
                <li><a href="<?= Url::toRoute(['mission/indexson'])?>">子任务</a></li>
                <li>修改</li>
            </ol>
        </div>

        <div class="oa-mission-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'm_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'm_joinusers')->dropDownList(yii\helpers\ArrayHelper::map($user,'oa_uid','oa_nickname'),['prompt'=>$nickname.' （ 可按住ctrl多选 ）','name' => 'joinusers[]','multiple' => true]) ?>

            <div>任务详情</div>
            <textarea name="content" style="width:100%;visibility: hidden;"><?= $model->m_content?></textarea>

            <?= $form->field($model, 'm_import')->dropDownList(['1'=>'普通','2'=>'紧急','3'=>'非常紧急'],['prompt'=>'- - 请确定任务优先级 - -']) ?>

            <!-- <?= $form->field($model, 'm_lv')->dropDownList(['A'=>'A级','B'=>'B级','C'=>'C级'],['prompt'=>'- - 请选择 - -']) ?> -->

            <?= $form->field($model, 'm_creat_time')->textInput(['value'=>$model->m_creat_time,'readonly'=>'true']) ?>

            <!--    <div>修改时间</div>-->
            <!--    <input type="date" name="update" value="--><!--" />-->

            <?= $form->field($model, 'm_edit_time')->textInput(['value'=>date('Y-m-d',time()),'readonly'=>'true']) ?>

            <!-- <?= $form->field($model, 'm_big_check')->dropDownList(['0'=>'未审核','1'=>'已审核','2'=>'未通过'],['prompt'=>'- - 请选择 - -']) ?>

            <?= $form->field($model, 'm_biger_check')->dropDownList(['0'=>'未审核','1'=>'已审核','2'=>'未通过'],['prompt'=>'- - 请选择 - -']) ?> -->

            <p>截至时间</p>
            <input type="date" name="endtime" style="width:100%"/>

            <!-- <?= $form->field($model, 'm_big_command')->textInput() ?>

            <?= $form->field($model, 'm_biger_command')->textInput() ?> -->

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>
