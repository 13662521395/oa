<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OaSchool */

$this->title ='山东柏瑞管理系统-校区详情';
$this->params['breadcrumbs'][] = ['label' => 'Oa Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-school-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'school_id',
            'school_name',
            'school_number',
            'school_address',
            'school_syno:ntext',
            'school_leader',
            'school_addper',
            // 'school_creattime',
            // 'school_softdel',
        ],
    ]) ?>
<?= Html::a('返回主页', ['index', 'id' => $model->school_id], ['class' => 'btn btn-primary']) ?>
</div>
