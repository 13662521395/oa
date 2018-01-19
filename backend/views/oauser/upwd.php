<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Oauser */
/* @var $form yii\widgets\ActiveForm */
$this->title = '山东柏瑞管理系统-修改密码';
$this->params['breadcrumbs'][] = $this->title;
?>
            <!-- 面包屑导航 -->
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ol class="breadcrumb">
                  <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">首页</a></li>
                  <li>修改密码</li>
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
 <?php $form = ActiveForm::begin([ 'action' => ['oauser/upwd'],'method'=>'post',]); ?>
            <div class="col-md-9">
		    <div class="form-group field-oauser-oa_pwd required">
			<label class="control-label" for="oauser-oa_pwd">原始密码</label>
			<input type="text" id="oauser-oa_opwd" class="form-control" name="OaUser[oa_pwd]" maxlength="35" aria-required="true">
			<div class="help-block"></div><span id="yz"></span>
			</div>

			<div class="form-group field-oauser-oa_pwd required">
			<label class="control-label" for="oauser-oa_pwd">新密码</label>
			<input type="text" id="oauser-oa_xpwd" class="form-control" name="OaUser[oa_xpwd]" maxlength="35" aria-required="true">
			<div class="help-block"></div>
			</div>

			<div class="form-group field-oauser-oa_pwd required">
			<label class="control-label" for="oauser-oa_pwd">确认密码</label>
			<input type="text" id="oauser-oa_qpwd" class="form-control" name="OaUser[oa_qpwd]" maxlength="35" aria-required="true">
			<div class="help-block"></div>
			</div>
			<!--模态框-->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                          修改密码
                        </h4>
                      </div>
                      <div class="modal-body">
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                        </button>
                        <button type="button" class="btn btn-primary a">
                          提交更改
                        </button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal -->
                </div>
			<div class="form-group">
			     <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'login-button','data-toggle'=>'modal','data-target'=>'#myModal','onclick'=>'return val(this)','style'=>'border-radius: 10px; border']) ?>
			</div>
            <?php ActiveForm::end(); ?>
            <script type="text/javascript">
                   			  $(function(){
                   			  	$("#oauser-oa_opwd").change(function(){
                                     var pwd = $('#oauser-oa_opwd').val();
                                      $.get("<?=Url::toRoute('oauser/pwd')?>",{pwd:pwd},function(data){    
					                     //alert(data);   
				                         $("#yz").html(data);
				                     	 var yzz = $('#yzz').text();
                   			  	         if(yzz == "输入有误"){
                   			  	         	$(".col-md-9").find("input[id=oauser-oa_xpwd]").attr("disabled",true);
                   			  	            $(".col-md-9").find("input[id=oauser-oa_qpwd]").attr("disabled",true);
                   			  	         }
                   			  	         if(yzz == "符合")
                   			  	         {
                   			  	         	$(".col-md-9").find("input[id=oauser-oa_xpwd]").attr("disabled",false);
                   			  	         	$(".col-md-9").find("input[id=oauser-oa_qpwd]").attr("disabled",false);
                   			  	         }
					                  });
                   			  	});
                   			  	$(".btn-primary").click(function(){
                   			  		 var pwd = $('#oauser-oa_opwd').val();
                                     var pwd1 = $('#oauser-oa_xpwd').val();
                                     var pwd2 = $('#oauser-oa_qpwd').val();
                                     if(pwd == '')
	                                  {
	                                  	$(".modal-body").html("请输入原密码")	; 
	                                  }
                                      else if(pwd1 == '')
	                                  {
	                                  	$(".modal-body").html("请输入新密码")	;       
	                                  }
	                                  else if(pwd1 != pwd2)
	                                  {
	                                  	$(".modal-body").html("前后密码不符，请正确输入"); 
	                                  }
	                                  else{
	                                  	$(".modal-body").html("请点击确认修改"); 
	                                  	
	                                  	$(".a").click(function(){
                   			  		      $.get("<?=Url::toRoute('oauser/upwdajax')?>",{pwd:pwd1},function(data){
                   			  		      	  //alert(data);
                   			  		      	  if(data)
					                          history.go(-1);
					                      });
                   			  	         });
	                                  }

                   			  	});
                   			  	
                   			  });
                   			 
                   </script>
       
               
