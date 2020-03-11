<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PemasukanJenis */

$this->title = 'Create Pemasukan Jenis';
$this->params['breadcrumbs'][] = ['label' => 'Pemasukan Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemasukan-jenis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
