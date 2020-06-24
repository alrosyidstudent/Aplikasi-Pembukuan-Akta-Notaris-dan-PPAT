<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Keluar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengeluaran">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Transaksi', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Transaksi Masuk', ['index'], ['class' => 'btn btn-success']) ?>
    </p>


    <div class="panel panel-primary">
        <div class="panel-heading">List Pengeluaran</div>   
            <div class="x_panel">
    <?php Pjax::begin(); ?>   
 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nominal',
            [
                'attribute' =>'tanggal',
                'filter'=>DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'tanggal',
                        'options' => ['placeholder' => 'Pilih tanggal'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true
                        ]
                    ])
            ],
            'keterangan',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>
</div>
