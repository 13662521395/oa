<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Oauser */

?>
 <div class="row">
<div class="col-lg-12">
          <h1>用户信息</h1>
          <div class="table-responsive"  >
              <table class="table table-bordered table-hover table-striped tablesorter"  id="data_table" >
                  <tr><th>序号</th><td><?= $models->oa_uid?></td></tr>
                  <tr><th>昵称</th><td><?= $models->oa_uname?></td></tr>
                  <tr><th>真实姓名</th><td><?= $models->oa_nickname?></td></tr>
                  <tr><th>性别</th>
                      <?php if($models->oa_sex == 1):?>
                      <td style="color:blur">男</td>
                      <?php endif?>
                      <?php if($models->oa_sex == 2):?>
                      <td tyle="color:yelower">女</td>
                      <?php endif?>
                  </tr>
                  <tr><th>电话号码</th><td><?= $models->oa_utel?></td></tr>
                  <tr><th>所属部门</th><td><?= $models['oadepartment']['dep_name']?></td></tr>
                  <tr><th>当前职位</th><td><?= $models['oaposition']['pos_name']?></td></tr>
                  <tr><th>所属校区</th><td><?= $models['oaschool']['school_name']?></td></tr>
                  <tr><th>所拥有权限</th><td><?php $arr = implode(',',$arr); echo $arr;?></td></tr>
                  <tr><th>加入时间</th><td><?=date('Y-m-d', $models->oa_ucreattime)?></td></tr>
            </table>
            <div class="infos">
            <a id="edit_btn" onclick="editAction(3)" class="btn btn-primary btn-sm" 
                      href='index.php?r=oauser/sindex'> 
                      <i class="glyphicon glyphicon-edit icon-white"></i>返回</a>
                     
            </div>
               
        </div>
</div>
