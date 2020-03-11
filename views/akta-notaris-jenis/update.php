<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisJenis */

$this->title = 'Update Akta Notaris Jenis: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-notaris-jenis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
