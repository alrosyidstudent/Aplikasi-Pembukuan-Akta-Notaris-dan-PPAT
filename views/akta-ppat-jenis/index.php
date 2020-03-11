<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AktaPpatJenisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelola Jenis Akta PPAT';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-jenis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Jenis Akta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['style' => 'width: 20px;'],
        ],
        [
            'attribute' => 'name',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 70px;'],
        ],
        [
            'attribute' => 'deskripsi',
            'vAlign' => 'left',
            'contentOptions' => ['style' => 'width: 200px;'],
        ],
        [
            'attribute' => 'prosess',
            'vAlign' => 'left',
            'format' => 'raw',
            //'contentOptions' => ['style' => 'width: 100px;'],
        ],
        ['class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['style' => 'width: 100px;'],
            'buttons' => [
                'proses' => function ($url, $model, $key) {
                    return Html::a('<span class="fa fa-list-ul" aria-hidden="true"></span> ', ['akta-ppat-jenis/proses', 'id' => $model->id]);
                },
            ],
            'template' => '{proses} {update} {view} {delete}'
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


