<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanProses */

$this->title = $model->akta_badan_jenis_proses_id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-proses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'akta_badan_jenis_proses_id' => $model->akta_badan_jenis_proses_id, 'akta_badan_id' => $model->akta_badan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'akta_badan_jenis_proses_id' => $model->akta_badan_jenis_proses_id, 'akta_badan_id' => $model->akta_badan_id], [
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
            'akta_badan_jenis_proses_id',
            'akta_badan_id',
            'keterangan',
            'tanggal',
        ],
    ]) ?>

</div>
