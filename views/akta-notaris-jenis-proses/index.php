<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AktaNotarisJenisProsesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akta Notaris Jenis Proses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-notaris-jenis-proses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Akta Notaris Jenis Proses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'akta_notaris_jenis_id',
            'deskripsi',
            'notaris_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
