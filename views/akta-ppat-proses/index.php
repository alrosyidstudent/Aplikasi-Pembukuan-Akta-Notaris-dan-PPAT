<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AktaPpatProsesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akta Ppat Proses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-proses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Akta Ppat Proses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'akta_ppat_id',
            'akta_ppat_jenis_proses_id',
            'keterangan',
            'tanggal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
