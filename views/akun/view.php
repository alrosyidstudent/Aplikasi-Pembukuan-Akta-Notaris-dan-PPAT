<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Akun */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Akuns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akun-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Index', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Perbaharui', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
            'debit',
            'kredit',
            'tanggal',
            'kategoriAkun.name',
            'ket',
        ],
    ]) ?>

</div>
