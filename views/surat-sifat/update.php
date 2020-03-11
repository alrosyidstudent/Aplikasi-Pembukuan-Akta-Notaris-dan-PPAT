<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SuratSifat */

$this->title = 'Perbaharui Sifat Surat: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Surat Sifats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-sifat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
