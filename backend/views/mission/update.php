<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\OaUser;
use app\models\OaMission;

date_default_timezone_set("Asia/Shanghai");
/* @var $this yii\web\View */
/* @var $model app\models\OaMission */

$this->title = '修改任务申请';
$this->params['breadcrumbs'][] = $this->title;

$session=Yii::$app->session;

$session->open();

$mission = OaMission::findOne($model->m_id);
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
                <li>修改</li>
            </ol>
        </div>

    <div class="oa-mission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'm_name')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'm_user')->dropDownList(OaUser::find()->select('oa_uname')->indexby('oa_uid')->column(),['prompt'=>'- - 请选择 - -']) ?> -->

    <?= $form->field($model, 'm_user')->textInput(['value'=>$data->oa_nickname,'readonly' => true])?>

    <div>任务详情</div>
    <textarea name="content" style="width:100%;visibility: hidden;"><?= $model->m_content?></textarea>

    <?= $form->field($model, 'm_import')->dropDownList(['1'=>'普通','2'=>'紧急','3'=>'非常紧急'],['prompt'=>'- - 请确定任务优先级 - -']) ?>

    <!-- <?= $form->field($model, 'm_lv')->dropDownList(['A'=>'A级','B'=>'B级','C'=>'C级'],['prompt'=>'- - 请选择 - -']) ?> -->

    <?= $form->field($model, 'm_creat_time')->textInput(['value'=>$model->m_creat_time,'readonly'=>'true']) ?>

    <!--    <div>修改时间</div>-->
    <!--    <input type="date" name="update" value="--><!--" />-->

    <?= $form->field($model, 'm_edit_time')->textInput(['value'=>date('Y-m-d',time()),'readonly'=>'true']) ?>

<!--    --><?php //if($session->get('uid') != 1){
//            echo '';
//          }else{
//            if($mission->m_big_check == 0){
//                echo $form->field($model, 'm_big_check')->dropDownList(['0'=>'未审核','1'=>'已审核','2'=>'未通过'],['prompt'=>'- - 请选择 - -']);
//            }
//            else if($mission->m_big_check == 1 && $mission->m_biger_check == 0){
//                echo $form->field($model, 'm_big_check')->dropDownList(['0'=>'未审核','1'=>'已审核','2'=>'未通过'],['prompt'=>'- - 请选择 - -','id'=>'sel','readonly'=>true]);
//                echo $form->field($model, 'm_biger_check')->dropDownList(['0'=>'未审核','1'=>'已审核','2'=>'未通过'],['prompt'=>'- - 请选择 - -']);
//            }
//            else{
//                echo '';
//            }
//          }
//     ?>
    
<!--    --><?php //if($session->get('uid')!=1){
//            echo '';
//          }else{
//            if($mission->m_big_command == ''){
//                echo $form->field($model, 'm_big_command')->textInput();
//            }
//            else if($mission->m_big_check != '' && $mission->m_biger_check == ''){echo $form->field($model, 'm_big_command')->textInput(['readonly'=>true]);
//                echo $form->field($model, 'm_biger_command')->textInput();
//            }
//            else{
//                echo '';
//            }
//          }
//     ?>
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