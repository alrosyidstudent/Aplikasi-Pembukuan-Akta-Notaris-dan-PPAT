<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DetilUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detil Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detil-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Detil User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'notaris_id',
            'user_id',
            'nama',
            'detil_usercol',
            // 'alamat',
            // 'rt',
            // 'rw',
            // 'desa_kel',
            // 'kelurahan_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
