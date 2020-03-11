<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akta-notaris-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'notaris_id') ?>

    <?= $form->field($model, 'nomor') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'akta_notaris_jenis_id') ?>

    <?php // echo $form->field($model, 'register') ?>

    <?php // echo $form->field($model, 'corporate_client_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
