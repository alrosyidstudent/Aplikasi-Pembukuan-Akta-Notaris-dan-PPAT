<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AktaBadanJenisProsesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akta Badan Jenis Proses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-jenis-proses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Akta Badan Jenis Proses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'deskripsi',
            'notaris_id',
            'jangka_waktu',
            'peringatkan',
            // 'akta_badan_jenis_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
