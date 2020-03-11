<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SuratBawahTangan */

$this->title = 'Perbaharui Surat Bawah Tangan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surat Bawah Tangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'surat_sifat_id' => $model->surat_sifat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-bawah-tangan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPihak' => $modelsPihak,
    ]) ?>

</div>
