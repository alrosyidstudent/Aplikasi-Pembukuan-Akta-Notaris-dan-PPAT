<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisJenisProses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akta-notaris-jenis-proses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'akta_notaris_jenis_id')->textInput() ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notaris_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
