<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Credit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'notaris_id')->textInput() ?>

    <?= $form->field($model, 'buy')->textInput() ?>

    <?= $form->field($model, 'used')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
