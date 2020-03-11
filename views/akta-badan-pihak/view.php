<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanPihak */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Pihaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-pihak-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'akta_badan_id' => $model->akta_badan_id, 'akta_badan_akta_badan_jenis_id' => $model->akta_badan_akta_badan_jenis_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'akta_badan_id' => $model->akta_badan_id, 'akta_badan_akta_badan_jenis_id' => $model->akta_badan_akta_badan_jenis_id], [
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
            'id',
            'selaku',
            'nama',
            'alamat',
            'rt',
            'rw',
            'dusun',
            'kelurahan_id',
            'npwp',
            'nik',
            'akta_badan_id',
            'akta_badan_akta_badan_jenis_id',
        ],
    ]) ?>

</div>
