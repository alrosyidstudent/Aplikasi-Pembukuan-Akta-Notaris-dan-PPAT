<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\widgets\Select2;/* @var $this yii\web\View */
/* @var $model app\models\Depresiasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="depresiasi-form">

    <?php $form = ActiveForm::begin();
    echo $form->field($model, "notaris_id")->hiddenInput(['value' => Yii::$app->user->identity->notaris_id])->label(false);

     ?>

   
    <?= $form->field($model, 'nominal')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput() ?>

    <?php
        echo $form->field($model,'akun_id')->widget(Select2::classname(), [
            'data' => \app\models\Akun::getOptions(),
            'id' => 'akun_id',
            'options' => ['placeholder' => 'Pilih..'],
            'pluginOptions' => [
             'allowClear' => true
            ],
        ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Perbarui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
