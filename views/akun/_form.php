<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Akun */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akun-form">

    <?php $form = ActiveForm::begin(); 
    echo $form->field($model, "notaris_id")->hiddenInput(['value' => Yii::$app->user->identity->notaris_id])->label(false);
    ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'debit')->textInput() ?>

    <?= $form->field($model, 'kredit')->textInput() ?>

    <?php
        echo $form->field($model, 'kategori_akun_id')->widget(Select2::classname(), [
            'data' => \app\models\KategoriAkun::getOptions(),
            'id' => 'kategori_akun_id',
            'options' => ['placeholder' => 'Pilih..'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
