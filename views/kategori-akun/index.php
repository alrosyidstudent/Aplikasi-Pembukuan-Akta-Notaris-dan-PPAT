<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\KategoriAkunSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori Akun';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-akun-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Kembali', ['akun/index'], ['class' => 'btn btn-danger']) ?>
       
    </p>
    
     <div class="panel panel-primary">
        <div class="panel-heading">List Kategori Akun</div>   
            <div class="x_panel">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'name',
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
</div>