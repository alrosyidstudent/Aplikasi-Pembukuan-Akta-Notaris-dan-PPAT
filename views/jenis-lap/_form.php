<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\JenisLap */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jenis-lap-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'format')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengda_id')
                ->dropDownList(\app\models\Pengda::getOptions(), [
                    'id' => 'pengda-id',
                    'prompt' => 'Pilih...'
                ]) ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Perbaharui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
