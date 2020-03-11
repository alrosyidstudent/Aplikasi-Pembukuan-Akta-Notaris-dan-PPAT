<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SuratJenis */

$this->title = 'Create Surat Jenis';
$this->params['breadcrumbs'][] = ['label' => 'Surat Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-jenis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
