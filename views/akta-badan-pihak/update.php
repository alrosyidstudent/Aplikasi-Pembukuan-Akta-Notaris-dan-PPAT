<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanPihak */

$this->title = 'Update Akta Badan Pihak: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Pihaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'akta_badan_id' => $model->akta_badan_id, 'akta_badan_akta_badan_jenis_id' => $model->akta_badan_akta_badan_jenis_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-badan-pihak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
