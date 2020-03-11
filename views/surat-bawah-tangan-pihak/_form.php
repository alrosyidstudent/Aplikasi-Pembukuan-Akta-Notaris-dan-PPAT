<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SuratBawahTanganPihak */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-bawah-tangan-pihak-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'surat_bawah_tangan_id')->textInput() ?>

    <?= $form->field($model, 'selaku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rw')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dusun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelurahan_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
