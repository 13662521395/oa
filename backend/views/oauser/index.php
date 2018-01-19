<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\filters\PageCache;
use backend\models\Building;
use backend\models\User;
use backend\models\Type;
use yii\widgets\LinkPager;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '个人中心';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.control-label {
	font-weight: bold;
	float: left;
	width: 70px;
	clear:both;
}
</style>
                           
						<div class="tab-pane active" id="one">		
							<div class="col-md-3">
							
								<a href="{:url('profile/avatar')}">
									<if condition="empty($avatar)"> 
										<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="assets/avatars/profile-pic.jpg" />
									<else />
										
									</if>
								</a>
								
							</div>
							<div class="col-md-9">
								<div class="form-group">
									<label class="control-label" for="input-user_nicename">昵称</label>
									<div><?= $models->oa_uname?></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-user_nicename">真实姓名</label>
									<div><?= $models->oa_nickname?></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-user_nicename">身份证号</label>
									<div><?= $models->oa_card?></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-sex">性别</label>
									<div>
									  <?php if($models->oa_sex == 1):?>
				                      <td style="color:blur">男</td>
				                      <?php endif?>
				                      <?php if($models->oa_sex == 2):?>
				                      <td tyle="color:yelower">女</td>
				                      <?php endif?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-birthday">年龄</label>
									<div><?= $models->oa_age?></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-user_nicename">电话号码</label>
									<div><?= $models->oa_utel?></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-user_nicename">工龄</label>
									<div><?= $models->oa_standing?></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-user_nicename">职位</label>
									<div><?= $models['oaposition']['pos_rank']?></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-user_nicename">所属部门</label>
									<div><?= $models['oadepartment']['dep_name']?></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-user_nicename">所属校区</label>
									<div><?= $models['oaschool']['school_name']?></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-user_nicename">管理部门</label>
									<div>
									<?php if($models->oa_auth == 1):?>
				                      <td style="color:blur">管理</td>
				                      <?php endif?>
				                      <?php if($models->oa_auth == 2):?>
				                      <td tyle="color:yelower">不管理</td>
				                      <?php endif?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-user_nicename">加入时间</label>
									<div><?= $models->oa_ucreattime?></div>
								</div>
								<div>
									<a href="index.php?r=oauser/update&id=<?= $models['oa_uid']?>" class="btn btn-primary">编辑</a>
									<a href="index.php?r=oauser/create" class="btn btn-primary">添加</a>
								</div>
							</div>
					</div>			

                </div>
</div>