<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatJenisProsesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akta-ppat-jenis-proses-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'deskripsi') ?>

    <?= $form->field($model, 'notaris_id') ?>

    <?= $form->field($model, 'jangka_waktu') ?>

    <?= $form->field($model, 'peringatkan') ?>

    <?php // echo $form->field($model, 'akta_ppat_jenis_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
