<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisJenisProses */

$this->title = 'Update Akta Notaris Jenis Proses: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris Jenis Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'akta_notaris_jenis_id' => $model->akta_notaris_jenis_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-notaris-jenis-proses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
