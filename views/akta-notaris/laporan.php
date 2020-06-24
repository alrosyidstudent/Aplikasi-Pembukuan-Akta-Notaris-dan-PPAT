<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akta Notaris';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-notaris-index">

    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="panel panel-primary">
        <div class="panel-heading"></div>
        <div class="x_panel">
            <table class="table table-striped table-hover table-condensed">
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan Januari</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['januari'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan Februari</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['februari'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan Maret</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['maret'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan April</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['april'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan Mei</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['mei'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan Juni</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['juni'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan Juli</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['juli'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan Agustus</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['agustus'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan Septembert</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['septembert'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan Oktober</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['oktober'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan November</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['november'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
                <tr>
                    <td >Laporan Pencatatan Akta Periode Bulan Desember</td>
                    <td width="10%"><?= Html::a('Lihat Laporan', ['desember'], ['class' => 'btn btn-sm btn-success']) ?></td>
                </tr>
            </table>



<!-- <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'notaris_id',
            'nomor',
            'tanggal',
            'nama',
            'akta_notaris_jenis_id',
            'register',
            'corporate_client_id',
            'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?> -->
