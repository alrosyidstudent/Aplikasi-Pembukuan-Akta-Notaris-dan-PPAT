<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanProses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akta-badan-proses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'akta_badan_jenis_proses_id')->textInput() ?>

    <?= $form->field($model, 'akta_badan_id')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
