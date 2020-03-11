<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AktaNotarisPihakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Pihak dalam Akta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-notaris-pihak-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    /*$jeniss = \app\models\AktaNotarisJenis::find()
        ->select('name')
        ->where(['notaris_id' => Yii::$app->user->identity->notaris_id])
        ->asArray()->all();

    $data_jenis[] = '';
    foreach ($jeniss as $jenis) {
        $data_jenis[] = $jenis['name'];
    }

    $clients = \app\models\CorporateClient::find()
        ->select('nama')
        ->where(['notaris_id' => Yii::$app->user->identity->notaris_id])
        ->asArray()->all();

    $data_client[] = '';
    foreach ($clients as $client) {
        $data_client[] = $client['nama'];
    }*/

    $gridColumns = [
        [
            'attribute' => 'nik',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 250px;'],
        ],
        [
            'attribute' => 'nama',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 250px;'],
        ],
        [
            'attribute' => 'alamat',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 250px;'],
        ],
        [
            'attribute' => 'dusun',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 250px;'],
        ],
        [
            'attribute' => 'kelurahanName',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 250px;'],
        ],
        [
            'attribute' => 'kecamatanName',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 250px;'],
        ],
        [
            'attribute' => 'kabupatenName',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 250px;'],
        ],

        /*[
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
        ],*/
        ['class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['style' => 'width: 100px;'],
            'buttons' => [
                'detil' => function ($url, $model, $key) {
                    return Html::a('<span class="fa fa-eye" aria-hidden="true"></span> ', ['akta-notaris/view', 'id' => $model->akta_notaris_id]);
                },
                /*'pihak' => function ($url, $model, $key) {
                    return Html::a('<span class="fa fa-user-o" aria-hidden="true"></span> ', ['akta-notaris/pihak', 'id' => $model->id]);
                },*/
            ],
            'template' => '{detil}'
        ],
    ];

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

