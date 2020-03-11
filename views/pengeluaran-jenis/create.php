<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengeluaranJenis */

$this->title = 'Create Pengeluaran Jenis';
$this->params['breadcrumbs'][] = ['label' => 'Pengeluaran Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengeluaran-jenis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
