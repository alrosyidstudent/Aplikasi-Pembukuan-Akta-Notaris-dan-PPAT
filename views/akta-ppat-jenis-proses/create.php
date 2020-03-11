<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatJenisProses */

$this->title = 'Create Akta Ppat Jenis Proses';
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppat Jenis Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-jenis-proses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
