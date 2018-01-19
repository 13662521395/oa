<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Oa Racords';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-racord-index">

   <!-- <h1><?/*= Html::encode($this->title) */?></h1>

    <p>
        <?/*= Html::a('Create Oa Racord', ['create'], ['class' => 'btn btn-success']) */?>
    </p>
    --><?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'racord_id',
            'racord_name',
            'racord_user',
            'racord_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>
    <style>
        .box{
            padding-top: 3.0em;
            width: 80%;
            margin:0 auto;
        }
    </style>
    <p class="text-danger">清除推送记录</p>
    <script>
        $(".text-danger").click(function () {
            var del=1;
            $.get("<?=Url::toRoute(['racord/tuncatetable']);?>",{del:del},function (data) {
                alert(data);
            });

            location.reload();
        });
    </script>
    <div class="box">
        <?php foreach ($data as $k=>$val): ?>
            <div class="alert alert-dismissable <?php
            $i  =$k+1;
            if($i%4==0)
            {
                echo 'alert-success';
            }
            else if($i%4==1)
            {
                echo 'alert-info';
            }
            else if($i%4==2)
            {
                echo 'alert-danger';
            }
            else if($i%4==3)
            {
                echo 'alert-warning';
            }
            ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>
                    注意!
                </h4> <strong><?php echo  date('Y-m-d H:i:s',$val->racord_time);?></strong><?= $val->racord_name; ?> <a href="javascript:void(0);" class="alert-link"></a>
            </div>
        <?php endforeach; ?>
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>


</div>
