<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatObjek */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppat Objeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-objek-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'akta_ppat_id' => $model->akta_ppat_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'akta_ppat_id' => $model->akta_ppat_id], [
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
            'akta_ppat_id',
            'status_objek',
            'nop',
            'luas_tanah',
            'luas_bangunan',
            'nomor_pajak',
            'njop_tanah',
            'njop_bangunan',
            'nilai_pengalihan',
            'ntpn',
            'bphtb',
            'pph',
            'keterangan',
        ],
    ]) ?>

</div>
