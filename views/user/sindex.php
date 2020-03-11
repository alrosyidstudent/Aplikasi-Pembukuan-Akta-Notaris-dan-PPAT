<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelola Staff';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah User', ['screate'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin();
    $data_status = array('Aktif','Non Aktif');

    $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['style' => 'width: 20px;'],
        ],
        'username',
        'staffName',
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'status',
            'contentOptions' => ['style' => 'width: 120px;'],
            'pageSummary' => true,
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => [
                    'data' => $data_status,
                    'autoWidget' => true,
                    'autoclose' => true,
                ]
            ],
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'cview' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> ', ['sview', 'id' => $model->id]);
                },
                'cupdate' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ', ['supdate', 'id' => $model->id]);
                },
            ],
            'contentOptions' => ['style' => 'width: 80px;'],
            'template' => '{cupdate} {cview}',
        ]
    ];

    echo GridView::widget([
        'id' => 'kv-grd-demo',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'pjax' => true, // pjax is set to always true for this demo
        'toolbar' => [
            //'{export}',
            //'{toggleData}',
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


