<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SuratBawahTanganPihak */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surat Bawah Tangan Pihaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-bawah-tangan-pihak-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'surat_bawah_tangan_id' => $model->surat_bawah_tangan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'surat_bawah_tangan_id' => $model->surat_bawah_tangan_id], [
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
            'surat_bawah_tangan_id',
            'selaku',
            'nama',
            'alamat',
            'rt',
            'rw',
            'dusun',
            'kelurahan_id',
        ],
    ]) ?>

</div>
