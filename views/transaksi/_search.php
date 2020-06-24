<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'jenis') ?>

    <?= $form->field($model, 'nominal') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'notaris_id') ?>

    <?php // echo $form->field($model, 'akta_ppat_id') ?>

    <?php // echo $form->field($model, 'akta_notaris_id') ?>

    <?php // echo $form->field($model, 'akta_badan_id') ?>

    <?php // echo $form->field($model, 'kategori_akun_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
