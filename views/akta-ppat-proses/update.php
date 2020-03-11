<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatProses */

$this->title = 'Update Akta Ppat Proses: ' . $model->akta_ppat_id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppat Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->akta_ppat_id, 'url' => ['view', 'akta_ppat_id' => $model->akta_ppat_id, 'akta_ppat_jenis_proses_id' => $model->akta_ppat_jenis_proses_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-ppat-proses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
