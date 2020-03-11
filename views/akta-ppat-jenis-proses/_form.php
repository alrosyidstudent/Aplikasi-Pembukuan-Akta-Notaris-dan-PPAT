<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatJenisProses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akta-ppat-jenis-proses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notaris_id')->textInput() ?>

    <?= $form->field($model, 'jangka_waktu')->textInput() ?>

    <?= $form->field($model, 'peringatkan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'akta_ppat_jenis_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
