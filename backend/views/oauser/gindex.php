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
 <div class="row">
          <div class="col-lg-12">
          <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 用户信息列表
            </div>
            <ul id="myTab" class="nav nav-tabs">
              <li ><a href="<?= Url::toRoute('oauser/index'); ?>">我的信息</a></li>
              <li ><a href="<?= Url::toRoute('oauser/sindex'); ?>" >查看所有用户</a></li>
              <li class="active"><a href="<?= Url::toRoute('oauser/gindex'); ?>" >设置管理员</a></li>
            </ul>  
          </div>
           
          
        

        
       
                
<div class="col-lg-12">
          <div class="table-responsive"  >
              <table class="table table-bordered table-hover table-striped tablesorter"  id="data_table" >
                <thead>
                  <tr>
                    <th>序号</th>
                    <th>昵称</th>
                    <th>真实姓名</th>
                    <th>性别</th>
                    <th>电话号码</th>
                    <th>密码</th>
                    <th>所属部门</th>
                    <th>当前职位</th>
                    <th>所属校区</th>
                    <th>所拥有权限</th>
                    <th>加入时间</th>
                    <th>操作</th>
                  </tr>
                </thead>

                <tbody>
                 <?php 
                /*序号计算*/
                $a=yii::$app->request->get('page')?yii::$app->request->get('page'):1;
                $i=$pagesize*($a-1)+1;
                ?>
                <?php foreach($models as $model):?>
                <tr id="rowid_1">
                  <td><?= $i++?></td>
                  <td><?= $model->oa_uname?></td>
                  <td><?= $model->oa_nickname?></td>
                  <?php if($model->oa_sex == 1):?>
                    <td style="color:blur">男</td>
                    <?php endif?>
                    <?php if($model->oa_sex == 2):?>
                    <td tyle="color:yelower">女</td>
                    <?php endif?>
                  <td><?= $model->oa_utel?></td>
                  <td><?= $model->oa_pwd?></td>
                  <td><?= $model['oadepartment']['dep_name']?></td>
                  <td><?= $model['oaposition']['pos_name']?></td>
                  <td><?= $model['oaschool']['school_name']?></td>
                  <td><?= $model->duty_id?></td>
                  <td><?=date('Y-m-d', $model->oa_ucreattime)?></td>
                  <td>
                  <?php if($model['oa_auth'] == 0):?>
                  <a id="edit_btn" onclick="lookAction(1)" class="btn btn-primary btn-sm" href='index.php?r=oauser/update3&id=<?= $model['oa_uid']?>'> <i class="glyphicon glyphicon-edit icon-white"></i>赋予权限</a>
                <?php endif?>
                  </td>
             </tr>
               <?php endforeach; ?> 
                </tbody>
              </table>
               
        </div>
</div>
</div><!-- /.row -->