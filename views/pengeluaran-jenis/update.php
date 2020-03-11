<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengeluaranJenis */

$this->title = 'Update Pengeluaran Jenis: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pengeluaran Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengeluaran-jenis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
