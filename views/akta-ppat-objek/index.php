<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AktaPpatObjekSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akta Ppat Objeks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-objek-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Akta Ppat Objek', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'akta_ppat_id',
            'status_objek',
            'nop',
            'luas_tanah',
            // 'luas_bangunan',
            // 'nomor_pajak',
            // 'njop_tanah',
            // 'njop_bangunan',
            // 'nilai_pengalihan',
            // 'ntpn',
            // 'bphtb',
            // 'pph',
            // 'keterangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
