<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanProses */

$this->title = 'Update Akta Badan Proses: ' . $model->akta_badan_jenis_proses_id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->akta_badan_jenis_proses_id, 'url' => ['view', 'akta_badan_jenis_proses_id' => $model->akta_badan_jenis_proses_id, 'akta_badan_id' => $model->akta_badan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-badan-proses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
