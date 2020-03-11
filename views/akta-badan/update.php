<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadan */

$this->title = 'Update Akta Badan: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'akta_badan_jenis_id' => $model->akta_badan_jenis_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-badan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
