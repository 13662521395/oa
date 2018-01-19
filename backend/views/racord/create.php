<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OaRacord */

$this->title = 'Create Oa Racord';
$this->params['breadcrumbs'][] = ['label' => 'Oa Racords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-racord-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
