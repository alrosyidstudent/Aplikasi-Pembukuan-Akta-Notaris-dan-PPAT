<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AktaBadanJenisSifatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelola Jenis Akta Badan Hukum / Usaha';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-jenis-sifat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Jenis Akta', ['akta-badan-jenis/sifat'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    /*$ruangs = \app\models\Ruang::find()
        ->select('nama')
        ->asArray()->all();

    $data_ruang[] = '';
    foreach ($ruangs as $ruang) {
        $data_ruang[] = $ruang['nama'];
    }*/

    $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['style' => 'width: 20px;'],
        ],
        [
            'attribute' => 'aktaBadanJenisName',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 100px;'],
        ],
        [
            'attribute' => 'name',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 170px;'],
        ],
        [
            'attribute' => 'prosess',
            'vAlign' => 'left',
            'format' => 'raw',
            //'contentOptions' => ['style' => 'width: 100px;'],
        ],
        /*[
            'attribute' => 'sifats',
            'vAlign' => 'left',
            'format' => 'raw',
            'contentOptions' => ['style' => 'width: 100px;'],
        ],*/
        /*[
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'ruangName',
            'pageSummary' => true,
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => [
                    'data' => $data_ruang,
                    'autoWidget' => true,
                    'autoclose' => true,
                ]
            ],
        ],*/
        ['class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['style' => 'width: 100px;'],
            'buttons' => [
                'proses' => function ($url, $model, $key) {
                    return Html::a('<span class="fa fa-list-ul" aria-hidden="true"></span> ', ['akta-badan-jenis-sifat/proses', 'id' => $model->id]);
                },
                'update_sifat' => function ($url, $model, $key) {
                    return Html::a('<span class="fa fa-pencil" aria-hidden="true"></span> ', ['akta-badan-jenis/update-sifat', 'id' => $model->id]);
                },
            ],
            'template' => '{proses} {update_sifat} {view} {delete}'
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


