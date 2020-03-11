<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SuratBawahTanganPihak */

$this->title = 'Create Surat Bawah Tangan Pihak';
$this->params['breadcrumbs'][] = ['label' => 'Surat Bawah Tangan Pihaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-bawah-tangan-pihak-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
