<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-form">

    <?php $form = ActiveForm::begin(); 
    echo $form->field($model, "notaris_id")->hiddenInput(['value' => Yii::$app->user->identity->notaris_id])->label(false);

    ?>

    <?= $form->field($model,'jenis')->dropDownList($model->dataJenisTransaksi(),[
                'class'=>'form-control','prompt'=>'pilih jenis..'
            ])?>

    <?= $form->field($model, 'nominal')->textInput() ?>

    <?php
        echo '<label>Tanggal</label>';
        echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'tanggal',
            'name' => 'tanggal',
            'value' => date('Y-m-d', strtotime('+30 days')),
            'options' => ['placeholder' => 'Pilih tanggal'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
                'todayHighlight' => true
            ]
        ]);
    ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

 
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
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
