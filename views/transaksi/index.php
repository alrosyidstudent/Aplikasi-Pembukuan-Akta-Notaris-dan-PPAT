<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use app\models\transaksi;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\Select2;



$this->title='Transaksi Pemasukan';
$this->params['breadcrubs'][] = $this->title;
 ?>
 <div class="transaksi">
 	<h1><?= Html::encode($this->title) ?></h1>
 	<?php  ?>
 </div>
	<p>
      <?= Html::a('Transaksi Pengeluaran', ['pengeluaran'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="panel panel-primary">
		<div class="panel-heading"></div>
	
	  		<div class="x_panel">

	  			<?= $this->render('_form', [
            	'model' => $model,
        		]) ?>
			</div>
	</div>






	<div class="panel-heading"> List Pemasukan</div>	
	<div class="x_panel">

		<?php 

		if (Yii::$app->user->identity->role == User::ROLE_NOTARIS) {
        $gridColumns = [
            /*[
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['style' => 'width: 10px;'],
            ],*/
            [
                'attribute' => 'nomor',
                'vAlign' => 'left',
                'contentOptions' => ['style' => 'width: 20px;'],
            ],
            [
                'attribute' => 'Keterangan Biaya',
                'vAlign' => 'left',
                'contentOptions' => ['style' => 'width: 250px;'],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'Kategori Akun',
                'contentOptions' => ['style' => 'width: 150px;'],
                
            ],

            [
                'attribute' => 'tanggal',
                'contentOptions' => ['style' => 'width: 50px;'],
                'format' => ['date', 'php:Y-m-d'],
                'filterType' => '\kartik\widgets\DatePicker',
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'weekStart' => '1',
                        'language' => 'uk',
                    ],
                ],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'Nominal',
                'contentOptions' => ['style' => 'width: 100px;'],
                'pageSummary' => true,
                
            ],
            
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 100px;'],
                'buttons' => [
                    'proses' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-list-ul" aria-hidden="true"></span> ', ['akta-notaris-proses/create', 'akta_notaris_id' => $model->id]);
                    },
                    /*'pihak' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-user-o" aria-hidden="true"></span> ', ['akta-notaris/pihak', 'id' => $model->id]);
                    },*/
                ],
                'template' => '{proses} {pihak} {update} {view}'
            ],
        ];
    } else {
        $gridColumns = [
            /*[
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['style' => 'width: 10px;'],
            ],*/
            [
                'attribute' => 'nomor',
                'vAlign' => 'left',
                'contentOptions' => ['style' => 'width: 20px;'],
            ],
            [
                'attribute' => 'nama',
                'vAlign' => 'left',
                'contentOptions' => ['style' => 'width: 250px;'],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'jenis',
                'contentOptions' => ['style' => 'width: 150px;'],
                'pageSummary' => true,
                // 'filterType' => GridView::FILTER_SELECT2,
                // 'filterWidgetOptions' => [
                //     'pluginOptions' => [
                //         'data' => $data_jenis,
                //         'autoWidget' => true,
                //         'autoclose' => true,
                //     ]
                // ],
            ],

            [
                'attribute' => 'tanggal',
                'contentOptions' => ['style' => 'width: 50px;'],
                'format' => ['date', 'php:Y-m-d'],
                'filterType' => '\kartik\widgets\DatePicker',
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'weekStart' => '1',
                        'language' => 'uk',
                    ],
                ],
            ],

            [
                'attribute' => 'pic',
                'vAlign' => 'left',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 100px;'],
              ],
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 100px;'],
                'buttons' => [
                ],
                'template' => '{view}'
            ],
        ];
    }


    // Pjax::begin();
    // echo GridView::widget([
    //     'id' => 'kv-grd-demo',
    //     'dataProvider' => $dataProvider,
    //     'filterModel' => $searchModel,
    //     'columns' => $gridColumns,
    //     'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    //     'pjax' => true, // pjax is set to always true for this demo
    //     'toolbar' => [
    //     ],
    //     'export' => [
    //         'fontAwesome' => true
    //     ],
    //     'bordered' => false,
    //     'striped' => true,
    //     'condensed' => true,
    //     'responsive' => true,
    //     'hover' => true,

    //     'showPageSummary' => false,
    //     'panel' => [
    //         'type' => GridView::TYPE_PRIMARY,
    //     ],
    //     'persistResize' => false,
    //     'exportConfig' => false,
    // ]);


		 ?>

</div>


