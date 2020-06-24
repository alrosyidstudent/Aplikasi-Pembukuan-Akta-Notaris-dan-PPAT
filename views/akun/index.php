<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AkunSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelola Akun';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akun-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Akun', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Kategori Akun', ['kategori-akun/index'], ['class' => 'btn btn-success']) ?>
         <?= Html::a('Depresiasi', ['depresiasi/index'], ['class' => 'btn btn-success']) ?>
    </p>

 <div class="panel panel-primary">
<div class="panel-heading">List Akun</div>   
            <div class="x_panel">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

                        
            'nama',
            'debit',
            'kredit',
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

            //menampilkan dropdown filter kategori akun
            [
            //method untuk  menampilkan nama dari id kategori akun yang berelasi
            'attribute' => 'kategori_akun_id',
            'value' => function($data) {
            return $data->kategoriAkun->name;
            },
            //filter untuk kategori akun
            'filter' => \kartik\select2\Select2::widget([
                'model' => $searchModel,
                'attribute' => 'kategori_akun_id',    
                'options' => ['placeholder' => 'Pilih kategori..'],          
                'data' => \app\models\KategoriAkun::getOptionsAkun(),
            ]),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
            </div>
    </div>
</div>
