<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\OaUser;
use app\models\OaMission;

date_default_timezone_set("Asia/Shanghai");
/* @var $this yii\web\View */
/* @var $model app\models\OaMission */

$this->title = '修改任务发布';
$this->params['breadcrumbs'][] = $this->title;

$session=Yii::$app->session;

$session->open();

$mission = OaMission::findOne($model->p_id);
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
                <li><a href="<?= Url::toRoute(['publish/index'])?>">任务</a></li>
                <li><a href="<?= Url::toRoute(['publish/indexson'])?>">子任务</a></li>
                <li>修改</a></li>
            </ol>
        </div>

    <div class="oa-mission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'p_name')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'p_user')->dropDownList(OaUser::find()->select('oa_uname')->indexby('oa_uid')->column(),['prompt'=>'- - 请选择 - -']) ?> -->

    <?= $form->field($model, 'p_user')->textInput(['value'=>$data->oa_nickname,'readonly' => true])?>

    <div>任务详情</div>
    <textarea name="content" style="width:100%;visibility: hidden;"><?= $model->p_content?></textarea>

    <?= $form->field($model, 'p_import')->dropDownList(['1'=>'普通','2'=>'紧急','3'=>'非常紧急'],['prompt'=>'- - 请确定任务优先级 - -']) ?>

    <?= $form->field($model, 'p_create_time')->textInput(['value'=>$model->p_create_time,'readonly'=>'true']) ?>

    <!--    <div>修改时间</div>-->
    <!--    <input type="date" name="update" value="--><!--" />-->

    <?= $form->field($model, 'p_edit_time')->textInput(['value'=>date('Y-m-d',time()),'readonly'=>'true']) ?>

    <p>截止时间</p>
    <input type="date" name="endtime" value="<?= $model->p_endtime?>" style="width:100%"/>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : '保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>

<script type="text/javascript"> 
window.onload=function(){
  var osel=document.getElementById("sel");
  osel.onfocus=function(){
    this.defaultIndex=this.selectedIndex;
  }
  osel.onchange=function(){
    this.selectedIndex=this.defaultIndex;
  }
}
</script> 