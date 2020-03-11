<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SuratBawahTangan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surat Bawah Tangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-bawah-tangan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'surat_sifat_id' => $model->surat_sifat_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'surat_sifat_id' => $model->surat_sifat_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nomor_urut',
            'tanggal',
            'jenis',
            'notaris_id',
            'surat_sifat_id',
        ],
    ]) ?>

</div>
