<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Oauser */
/* @var $form yii\widgets\ActiveForm */
$this->title = '山东柏瑞管理系统-个人资料';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauser-form">
     <!-- 面包屑导航 -->
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ol class="breadcrumb">
                  <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">首页</a></li>
                  <li>个人资料</li>
                </ol>

               <div class="nav-search" id="nav-search">
                    <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="icon-search nav-search-icon"></i>
                                </span>
                    </form>
                </div>
            </div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oa_uname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oa_nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oa_card')->textInput(['maxlength' => true]) ?>
    
    <script type="text/javascript">
    //js验证身份证号
     $(function(){
        $('#oauser-oa_card').change(function(){
             /*验证身份证号*/
             var usercode = $('#oauser-oa_card').val();
             if(usercode=='' || usercode.length != 18){ 
             alert('请输入18位正确身份证号'); 
             return false;
             }
             /*获取年龄*/
             var date = new Date();
             var year = date.getFullYear(); 
             var birthday_year = parseInt(usercode.substr(6,4));
             var userage= year - birthday_year;
             $('#oauser-oa_age').val(userage); 
             /*获取性别*/
             var aa=usercode.substr(16,1);
             if(parseInt(aa) % 2 == 0)
             {
                 $(".oauser-form").find("input[value=2]").attr("checked",true);
             }
             else
             {
                $(".oauser-form").find("input[value=1]").attr("checked",true);
             }
         })
     })
    </script>
    <?= $form->field($model, 'oa_age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oa_sex')->radioList(['1' => '男','2' => '女']) ?>

    <?= $form->field($model, 'oa_standing')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'oa_utel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pos_id')->dropDownList(ArrayHelper::map($pos,'pos_id','pos_name'));?>

    <?= $form->field($model,'dep_id')->dropDownList(ArrayHelper::map($dep,'dep_id','dep_name'));?>

    <?= $form->field($model, 'school_id')->dropDownList(ArrayHelper::map($school,'school_id','school_name'));?>

    <!--<?= $form->field($model, 'oa_ucreattime')->textInput(['maxlength' => true,'readonly'=>true])->hiddenInput()->label(false) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : '保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','style'=>'border-radius: 10px; border']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
