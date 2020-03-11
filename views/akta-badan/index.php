<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AktaBadanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelola Akta Badan Hukum/Usaha';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Akta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $jeniss = \app\models\AktaBadanJenis::find()
        ->select('name')
        ->asArray()->all();

    $data_jenis[] = '';
    foreach ($jeniss as $jenis) {
        $data_jenis[] = $jenis['name'];
    }

    $sifats = \app\models\AktaBadanJenisSifat::find()
        ->select('name')
        ->asArray()->all();

    $data_sifat[] = '';
    foreach ($sifats as $sifat) {
        if (!in_array($sifat['name'], $data_sifat)) {
            $data_sifat[] = $sifat['name'];
        }
    }

    $clients = \app\models\CorporateClient::find()
        ->select('nama')
        ->where(['notaris_id' => Yii::$app->user->identity->notaris_id])
        ->asArray()->all();

    $data_client[] = '';
    foreach ($clients as $client) {
        $data_client[] = $client['nama'];
    }

    if (Yii::$app->user->identity->role == User::ROLE_NOTARIS) {
        $gridColumns = [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['style' => 'width: 20px;'],
            ],
            [
                'attribute' => 'nama',
                'vAlign' => 'left',
                'contentOptions' => ['style' => 'width: 200px;'],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'jenis',
                'contentOptions' => ['style' => 'width: 100px;'],
                'pageSummary' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'data' => $data_jenis,
                        'autoWidget' => true,
                        'autoclose' => true,
                    ]
                ],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'sifat',
                'contentOptions' => ['style' => 'width: 100px;'],
                'pageSummary' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'data' => $data_sifat,
                        'autoWidget' => true,
                        'autoclose' => true,
                    ]
                ],
            ],
            [
                'attribute' => 'nomor',
                'vAlign' => 'left',
                'contentOptions' => ['style' => 'width: 70px;'],
            ],
            [
                'attribute' => 'tanggal',
                'contentOptions' => ['style' => 'width: 100px;'],
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
                'attribute' => 'clientName',
                'contentOptions' => ['style' => 'width: 100px;'],
                'pageSummary' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'data' => $data_client,
                        'autoWidget' => true,
                        'autoclose' => true,
                    ]
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
                    'proses' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-list-ul" aria-hidden="true"></span> ', ['akta-badan-jenis-sifat/proses', 'id' => $model->id]);
                    },
                ],
                'template' => '{proses} {update} {view} '
            ],
        ];
    } else {
        $gridColumns = [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['style' => 'width: 20px;'],
            ],
            [
                'attribute' => 'nama',
                'vAlign' => 'left',
                'contentOptions' => ['style' => 'width: 200px;'],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'jenis',
                'contentOptions' => ['style' => 'width: 100px;'],
                'pageSummary' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'data' => $data_jenis,
                        'autoWidget' => true,
                        'autoclose' => true,
                    ]
                ],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'sifat',
                'contentOptions' => ['style' => 'width: 100px;'],
                'pageSummary' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'data' => $data_sifat,
                        'autoWidget' => true,
                        'autoclose' => true,
                    ]
                ],
            ],
            [
                'attribute' => 'nomor',
                'vAlign' => 'left',
                'contentOptions' => ['style' => 'width: 70px;'],
            ],
            [
                'attribute' => 'tanggal',
                'contentOptions' => ['style' => 'width: 100px;'],
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
                'attribute' => 'clientName',
                'contentOptions' => ['style' => 'width: 100px;'],
                'pageSummary' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'data' => $data_client,
                        'autoWidget' => true,
                        'autoclose' => true,
                    ]
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

    Pjax::begin();
    echo GridView::widget([
        'id' => 'kv-grd-demo',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'pjax' => true, // pjax is set to always true for this demo
        'toolbar' => [
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => false,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,

        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
        ],
        'persistResize' => false,
        'exportConfig' => false,
    ]);

    ?>
    <?php Pjax::end(); ?></div>


