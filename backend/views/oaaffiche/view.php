<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OaAffiche */


$this->params['breadcrumbs'][] = ['label' => 'Oa Affiches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-affiche-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       <a id="edit_btn" onclick="lookAction(1)" class="btn btn-primary btn-sm" href='index.php?r=oaaffiche/index'> 返回</a>
    </p>

     <table id="w0" class="table table-striped table-bordered detail-view"><tr><th>序号</th><td>1</td></tr>
    <tr><th>公告标题</th><td><?= $model->aff_title?></td></tr>
    <tr><th>公告内容</th><td><?= $model->aff_content?></td></tr>
    <tr><th>发布用户</th><td><?= $model['oaUser']['oa_nickname']?></td></tr>
    <tr><th>发布类型</th><?php if($model->aff_pos == 1):?>
                  <td style="color:blur" class="quan">全员公告</td>
                <?php endif?>
                <?php if($model->aff_pos == 2):?>
                  <td tyle="color:yelower" class="zhi">指定部门公告</td>
                <?php endif?>
                <?php if($model->aff_pos == 3):?>
                  <td tyle="color:yelower" class="zhi">领导公告</td>
                <?php endif?></tr>
    <tr><th>发布对象</th><td><?php $arr = implode(',',$arr); echo $arr;?></td></tr>
<!--</td></tr></table>-->

</div>
