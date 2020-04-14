<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Transaksi', ['create'], ['class' => 'btn btn-primary']) ?>
         <?= Html::a('Transaksi keluar', ['pengeluaran'], ['class' => 'btn btn-success']) ?>
    </p>


    <div class="panel panel-primary">
        <div class="panel-heading">List Pemasukan</div>   
            <div class="x_panel">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nominal',
            'tanggal',
            [
            'header'=>'Keterangan',
            'value'=>'keterangan',
            'filter'=>Html::textInput('keterangan',null,['class'=>'form-control'])
            ],  

           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>

