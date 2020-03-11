<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SuratBawahTanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelola Surat Bawah Tangan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-bawah-tangan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Surat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nomor_urut',
            'tanggal',
            'jenis',
            //'notaris_id',
            'surat_sifat_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<div class="clearfix"></div>