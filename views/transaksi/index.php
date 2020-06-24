<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Transaksi', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Transaksi keluar', ['pengeluaran'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="panel panel-primary">
        <div class="panel-heading">List Pemasukan</div>   
            <div class="x_panel">
<?php Pjax::begin(); ?>   
 <?= GridView::widget([

        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
//             array(
// 'attribute'=>'nominal',
// 'value'=>Yii::app()->numberFormatter->format("Rp ###,###,###",$data->nominal),
// ),          
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
             'nominal',
            
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>


    </div>
</div>
</div>
