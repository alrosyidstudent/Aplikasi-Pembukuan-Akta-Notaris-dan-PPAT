<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Keluar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengeluaran">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Transaksi', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Transaksi Masuk', ['index'], ['class' => 'btn btn-success']) ?>
    </p>


    <div class="panel panel-primary">
        <div class="panel-heading">List Pengeluaran</div>   
            <div class="x_panel">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nominal',
            'tanggal',
            'keterangan',
            // 'notaris_id',
            // 'akta_ppat_id',
            // 'akta_notaris_id',
            // 'akta_badan_id',
            // 'kategori_akun_id',
            // 'register',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
