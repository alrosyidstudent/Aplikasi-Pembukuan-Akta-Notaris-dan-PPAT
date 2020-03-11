<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanJenis */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
/*echo '<pre>';
print_r($model->getSifats());
echo '</pre>';*/
?>
<div class="akta-badan-jenis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Lanjutkan', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Perbaharui', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah anda yakin akan menghapus item ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'sifats',
            //'prosess'
        ],
    ]) ?>

</div>
