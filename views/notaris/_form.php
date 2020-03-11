<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Notaris */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notaris-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telepon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>

    <h2>Tempat Kedudukan</h2>
    <div class="ln_solid"></div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'provinsi_id')
                ->dropDownList(\app\models\Provinsi::getOptions(), [
                    'id' => 'provinsi-id',
                    'prompt' => 'Pilih...'
                ])
            ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'kabupaten_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'kabupaten-id'],
                'pluginOptions' => [
                    'depends' => ['provinsi-id'],
                    'placeholder' => 'Pilih...',
                    'url' => Url::to(['/kabupaten/kabupaten'])
                ]
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'kecamatan_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'kecamatan-id'],
                'pluginOptions' => [
                    'depends' => ['kabupaten-id'],
                    'placeholder' => 'Pilih...',
                    'url' => Url::to(['/kecamatan/kecamatan'])
                ]
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'kelurahan_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'kelurahan-id'],
                'pluginOptions' => [
                    'depends' => ['kecamatan-id'],
                    'placeholder' => 'Pilih...',
                    'url' => Url::to(['/kelurahan/kelurahan'])
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-1">
            <?= $form->field($model, 'rt')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-1">
            <?= $form->field($model, 'rw')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'dusun')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
