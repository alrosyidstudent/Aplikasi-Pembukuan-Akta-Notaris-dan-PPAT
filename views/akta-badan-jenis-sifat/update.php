<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanJenisSifat */

$this->title = 'Update Akta Badan Jenis Sifat: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Jenis Sifats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'akta_badan_jenis_id' => $model->akta_badan_jenis_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-badan-jenis-sifat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
