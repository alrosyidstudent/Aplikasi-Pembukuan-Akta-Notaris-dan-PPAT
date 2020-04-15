<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\AktaNotaris */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-notaris-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'notaris_id',
            'nomor',
            'tanggal',
            'nama',
            // 'akta_notaris_jenis_id',
            // 'register',
            // 'corporate_client_id',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>

</div>
