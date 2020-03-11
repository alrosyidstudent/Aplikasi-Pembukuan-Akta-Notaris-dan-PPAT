<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SuratBawahTanganPihakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Bawah Tangan Pihaks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-bawah-tangan-pihak-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Surat Bawah Tangan Pihak', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'surat_bawah_tangan_id',
            'selaku',
            'nama',
            'alamat',
            // 'rt',
            // 'rw',
            // 'dusun',
            // 'kelurahan_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
