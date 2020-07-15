<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisProses */
/* @var $form yii\widgets\ActiveForm */
$akta=\app\models\AktaNotaris::find()
    ->where(['id'=>$model->akta_notaris_id])
    ->one();

echo DetailView::widget([
    'model' => $akta,
    'attributes' => [
        'nama',
        'jenis',
        'nomor',
        'tanggal',
    ],
]); ?>

<div class="akta-notaris-proses-form">    

    <?php
    // $prosess = \app\models\AktaNotarisJenisProses::find()
    // ->select('id')
    // ->where(['notaris_id' => Yii::$app->user->identity->notaris_id])
    // ->asArray()->all();

    // $data_proses[] = '';
    // foreach ($prosess as $proses) {
    //     $data_proses[] = $proses['id'];
    // }
    $form = ActiveForm::begin();

    echo $form->field($model, "akta_notaris_jenis_id")->hiddenInput(['value' => $akta->akta_notaris_jenis_id])->label(false);
    echo $form->field($model, "akta_notaris_id")->hiddenInput(['value' => $model->akta_notaris_id])->label(false);
    echo $form->field($model, "tanggal")->hiddenInput(['value' => date("Y-m-d")])->label(false);
    echo $form->field($model, 'akta_notaris_jenis_proses_id')->widget(Select2::classname(), [
        'data' => \app\models\AktaNotarisJenisProses::getOptions($akta->akta_notaris_jenis_id),
        'id' => 'akta-notaris-jenis-proses-id',
        'options' => ['placeholder' => 'Pilih..'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?> 

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
