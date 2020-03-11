<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanJenis */

$this->title = 'Perbaharui Jenis Akta Badan Hukum / Usaha\': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-badan-jenis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_sifat', [
        'model' => $model,
        'modelsSifat' => $modelsSifat,
    ]) ?>

</div>
