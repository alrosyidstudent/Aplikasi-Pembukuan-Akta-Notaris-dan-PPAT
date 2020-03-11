<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatProses */

$this->title = $model->akta_ppat_id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppat Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-proses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kembali', ['akta-ppat/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'akta_ppat_id' => $model->akta_ppat_id, 'akta_ppat_jenis_proses_id' => $model->akta_ppat_jenis_proses_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'akta_ppat_id' => $model->akta_ppat_id, 'akta_ppat_jenis_proses_id' => $model->akta_ppat_jenis_proses_id], [
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
            'akta_ppat_id',
            'akta_ppat_jenis_proses_id',
            'keterangan',
            'tanggal',
        ],
    ]) ?>

</div>
