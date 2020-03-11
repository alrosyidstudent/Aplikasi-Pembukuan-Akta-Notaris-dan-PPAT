<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisProses */

$this->title = 'Update Akta Notaris Proses: ' . $model->akta_notaris_jenis_proses_id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->akta_notaris_jenis_proses_id, 'url' => ['view', 'akta_notaris_jenis_proses_id' => $model->akta_notaris_jenis_proses_id, 'akta_notaris_id' => $model->akta_notaris_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-notaris-proses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
