<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatObjek */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akta-ppat-objek-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'akta_ppat_id')->textInput() ?>

    <?= $form->field($model, 'status_objek')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nop')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'luas_tanah')->textInput() ?>

    <?= $form->field($model, 'luas_bangunan')->textInput() ?>

    <?= $form->field($model, 'nomor_pajak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'njop_tanah')->textInput() ?>

    <?= $form->field($model, 'njop_bangunan')->textInput() ?>

    <?= $form->field($model, 'nilai_pengalihan')->textInput() ?>

    <?= $form->field($model, 'ntpn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bphtb')->textInput() ?>

    <?= $form->field($model, 'pph')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
