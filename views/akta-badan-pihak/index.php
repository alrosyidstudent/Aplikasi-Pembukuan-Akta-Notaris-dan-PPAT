<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AktaBadanPihakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akta Badan Pihaks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-pihak-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Akta Badan Pihak', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'selaku',
            'nama',
            'alamat',
            'rt',
            // 'rw',
            // 'dusun',
            // 'kelurahan_id',
            // 'npwp',
            // 'nik',
            // 'akta_badan_id',
            // 'akta_badan_akta_badan_jenis_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
