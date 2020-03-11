<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SuratBawahTanganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-bawah-tangan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nomor_urut') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'jenis') ?>

    <?= $form->field($model, 'notaris_id') ?>

    <?php // echo $form->field($model, 'surat_sifat_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
