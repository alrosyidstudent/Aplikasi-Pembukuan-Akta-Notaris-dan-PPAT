<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DepresiasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Depresiasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="depresiasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Depresiasi', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Kembali', ['akun/index'], ['class' => 'btn btn-danger']) ?>
    </p>

    <div class="panel panel-primary">
        <div class="panel-heading">List Depresiasi</div>   
            <div class="x_panel">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'nominal',
            'keterangan',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
</div>
</div>
