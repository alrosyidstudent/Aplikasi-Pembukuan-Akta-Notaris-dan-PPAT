<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanJenisProses */

$this->title = 'Update Akta Badan Jenis Proses: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Jenis Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-badan-jenis-proses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
