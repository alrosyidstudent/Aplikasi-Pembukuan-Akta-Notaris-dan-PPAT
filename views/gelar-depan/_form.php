<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GelarDepan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gelar-depan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'singkatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kepanjangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
