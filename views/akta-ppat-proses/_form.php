<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatProses */
/* @var $form yii\widgets\ActiveForm */
$akta=\app\models\AktaPpat::find()
    ->where(['id'=>$model->akta_ppat_id])
    ->one();

echo DetailView::widget([
    'model' => $akta,
    'attributes' => [
        'nomor',
        'nop',
        'jenis',
        'tanggal',
    ],
]);

?>

<div class="akta-ppat-proses-form">

    <?php $form = ActiveForm::begin();

    echo $form->field($model, "akta_ppat_jenis_id")->hiddenInput(['value' => $akta->akta_ppat_jenis_id])->label(false);
    echo $form->field($model, "akta_notaris_id")->hiddenInput(['value' => $model->akta_ppat_id])->label(false);
    echo $form->field($model, "tanggal")->hiddenInput(['value' => date("Y-m-d")])->label(false);
    echo $form->field($model, 'akta_ppat_jenis_proses_id')->widget(Select2::classname(), [
        'data' => \app\models\AktaPpatJenisProses::getOptions($akta->akta_ppat_jenis_id),
        'id' => 'akta-ppat-jenis-proses-id',
        'options' => ['placeholder' => 'Pilih..'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Perbaharui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
