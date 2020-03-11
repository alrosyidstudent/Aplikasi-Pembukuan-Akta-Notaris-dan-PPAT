<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatObjekSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akta-ppat-objek-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'akta_ppat_id') ?>

    <?= $form->field($model, 'status_objek') ?>

    <?= $form->field($model, 'nop') ?>

    <?= $form->field($model, 'luas_tanah') ?>

    <?php // echo $form->field($model, 'luas_bangunan') ?>

    <?php // echo $form->field($model, 'nomor_pajak') ?>

    <?php // echo $form->field($model, 'njop_tanah') ?>

    <?php // echo $form->field($model, 'njop_bangunan') ?>

    <?php // echo $form->field($model, 'nilai_pengalihan') ?>

    <?php // echo $form->field($model, 'ntpn') ?>

    <?php // echo $form->field($model, 'bphtb') ?>

    <?php // echo $form->field($model, 'pph') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
