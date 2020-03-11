<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadan */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Index', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Perbaharui', ['update', 'id' => $model->id, 'akta_badan_jenis_id' => $model->akta_badan_jenis_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id, 'akta_badan_jenis_id' => $model->akta_badan_jenis_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah anda yakin untuk menghapus item ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nomor',
            'tanggal',
            'jenis',
            'sifat',
            'kelurahan_id',
            'alamat',
            'rt',
            'rw',
            'dusun',
            'register',
            'clientName',
        ],
    ]) ?>

</div>
