<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenisLap */

$this->title = 'Update Jenis Lap: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Laps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-lap-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
