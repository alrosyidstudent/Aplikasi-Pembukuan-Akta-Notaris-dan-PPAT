<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akta-ppat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'notaris_id') ?>

    <?= $form->field($model, 'nomor') ?>

    <?= $form->field($model, 'akta_ppat_jenis_id') ?>

    <?= $form->field($model, 'no_objek') ?>

    <?php // echo $form->field($model, 'kelurahan_id') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'rt') ?>

    <?php // echo $form->field($model, 'rw') ?>

    <?php // echo $form->field($model, 'dusun') ?>

    <?php // echo $form->field($model, 'corporate_client_id') ?>

    <?php // echo $form->field($model, 'register') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'luas_tanah') ?>

    <?php // echo $form->field($model, 'luas_bangunan') ?>

    <?php // echo $form->field($model, 'nilai_pengalihan') ?>

    <?php // echo $form->field($model, 'nop') ?>

    <?php // echo $form->field($model, 'njop_tanah') ?>

    <?php // echo $form->field($model, 'njop_bangunan') ?>

    <?php // echo $form->field($model, 'ssp_tanggal') ?>

    <?php // echo $form->field($model, 'ssp_nilai') ?>

    <?php // echo $form->field($model, 'sspd_tanggal') ?>

    <?php // echo $form->field($model, 'sspd_nilai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
