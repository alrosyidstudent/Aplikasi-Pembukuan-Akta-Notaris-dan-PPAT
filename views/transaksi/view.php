<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */

$this->title = $model->keterangan;
$this->params['breadcrumbs'][] = ['label' => 'Transaksis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Perbaharui', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Anda yakin ingin menghapus transaksi ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([     
        'model' => $model,
        'attributes' => [

            'jenis',
            'nominal',
            'tanggal',
            'keterangan',
            'kategoriAkun.name',
            'aktaNotaris.nama',
            'aktaBadan.nama',
            'aktaPpat.alamat',
            
        ],
    ]) ?>

</div>
