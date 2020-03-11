<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatJenis */

$this->title = 'Update Akta Ppat Jenis: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppat Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-ppat-jenis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
