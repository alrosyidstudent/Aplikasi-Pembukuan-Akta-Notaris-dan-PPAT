<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisProses */

$this->title = $model->akta_notaris_jenis_proses_id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-notaris-proses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kembali', ['akta-notaris/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'akta_notaris_jenis_proses_id' => $model->akta_notaris_jenis_proses_id, 'akta_notaris_id' => $model->akta_notaris_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'akta_notaris_jenis_proses_id' => $model->akta_notaris_jenis_proses_id, 'akta_notaris_id' => $model->akta_notaris_id], [
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
            'akta_notaris_jenis_proses_id',
            'akta_notaris_id',
            'keterangan',
            'tanggal',
        ],
    ]) ?>

</div>
