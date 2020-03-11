<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SuratBawahTanganPihak */

$this->title = 'Update Surat Bawah Tangan Pihak: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surat Bawah Tangan Pihaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'surat_bawah_tangan_id' => $model->surat_bawah_tangan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-bawah-tangan-pihak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
