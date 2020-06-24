<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Depresiasi */

$this->title = 'Perbarui Depresiasi: ' . $model->keterangan;
$this->params['breadcrumbs'][] = ['label' => 'Depresiasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="depresiasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
