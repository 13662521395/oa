<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Oauser */
/* @var $form yii\widgets\ActiveForm */

$this->title = '修改: ' . $model->oa_uid;
$this->params['breadcrumbs'][] = ['label' => 'Oa Affiches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oa_uid, 'url' => ['view', 'id' => $model->oa_uid]];
$this->params['breadcrumbs'][] = '修改';
?>

<div class="oauser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oa_uname')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'oa_nickname')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'oa_sex')->radioList(['1' => '男','2' => '女']) ?>
    
    <?= $form->field($model, 'oa_utel')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'oa_pwd')->textInput(['maxlength' => true,'readonly'=>true]) ?>
   
    <?= $form->field($model,'dep_id')->dropDownList(ArrayHelper::map($dep,'dep_id','dep_name'));?>

    <?= $form->field($model, 'pos_id')->dropDownList(ArrayHelper::map($pos,'pos_id','pos_name'));?>

    <?= $form->field($model, 'school_id')->dropDownList(ArrayHelper::map($school,'school_id','school_name'));?>
    
     <div class="form-group field-oauser-duty_id">
    <label class="control-label">所拥有的部门权限</label>
    <input type="hidden" name="OaUser[duty_id]" value=""><div id="oauser-duty_id"><label>
    <?php foreach($duty as $du):?>
    <input type="checkbox" name="OaUser[duty_id][]" value="<?= $du['duty_id']?>"><?= $du['duty_name']?></label>
     <?php endforeach; ?> 
    </div>

    <div class="help-block"></div>
    </div>
   
    <?= $form->field($model, 'oa_ucreattime')->textInput(['maxlength' => true,'readonly'=>true])->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update2', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
