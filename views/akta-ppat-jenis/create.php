<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatJenis */

$this->title = 'Tambah Jenis Akta PPAT';
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppat Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-jenis-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
