<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatPihak */
/* @var $form yii\widgets\ActiveForm */
$akta=\app\models\AktaPpat::findOne($model->akta_ppat_id);
?>
<div class="row">
    <div class="col-sm-6">
        <div class="akta-notaris-view">
            <?= DetailView::widget([
                'model' => $akta,
                'attributes' => [
                    'nomor',
                    'tanggal',
                    'jenis',
                    'clientName',
                ],
            ]) ?>

        </div>
    </div>
</div>

<h3>Detil Pihak</h3>
<div class="akta-ppat-pihak-form">

    <?php $form = ActiveForm::begin();
    echo $form->field($model, "akta_ppat_id")->hiddenInput(['value' => $model->akta_ppat_id])->label(false);
    if(isset($model->id)){
        echo $form->field($model, "id")->hiddenInput(['value' => $model->id])->label(false);
    }

    ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?php
            echo $form->field($model, 'selaku')->widget(Select2::classname(), [
                'data' => \app\models\Pihak::getPpatOptions(),
            ]);
            ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?php
            echo $form->field($model, 'provinsi_id')->widget(Select2::classname(), [
                'data' => \app\models\Provinsi::getOptions(),
            ]);
            ?>

        </div>
        <div class="col-sm-3">
            <?php
            $kab=\app\models\Kabupaten::find()->where(['id'=>$model->kabupaten_id])->one();
            if(isset($model->kelurahan_id)){
                echo Html::hiddenInput('kelurahan-1', $model->kelurahan_id, ['id'=>'kelurahan-1']);
                echo Html::hiddenInput('kecamatan-1', $model->kecamatan_id, ['id'=>'kecamatan-1']);
            }
            echo Html::hiddenInput('provinsi-1', $model->provinsi_id, ['id'=>'provinsi-1']);
            echo Html::hiddenInput('kabupaten-1', $model->kabupaten_id, ['id'=>'kabupaten-1']);

            echo $form->field($model, 'kabupaten_id')->widget(DepDrop::classname(), [
                'type'=>DepDrop::TYPE_SELECT2,
                'data' => \app\models\Kabupaten::getKabupatenSelectedProvinsi($model->provinsi_id),
                'options'=>['id'=>'kabupaten-id', 'placeholder'=>'Pilih ...'],
                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                'pluginOptions'=>[
                    'depends'=>['aktappatpihak-provinsi_id'],
                    'url' => Url::to(['/kabupaten/kabupaten']),
                    'params'=>['kabupaten-1']
                ]
            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo $form->field($model, 'kecamatan_id')->widget(DepDrop::classname(), [
                'type'=>DepDrop::TYPE_SELECT2,
                'data' => \app\models\Kecamatan::getKecamatanSelectedKabupaten($model->kabupaten_id),
                'options'=>['id'=>'kecamatan-id', 'placeholder'=>'Pilih ...'],
                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                'pluginOptions'=>[
                    'depends'=>['kabupaten-id'],
                    'url' => Url::to(['kecamatan/kecamatan']),
                    'params'=>['kecamatan-1']
                ]
            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo $form->field($model, 'kelurahan_id')->widget(DepDrop::classname(), [
                'type'=>DepDrop::TYPE_SELECT2,
                'data' => \app\models\Kelurahan::getKelurahanSelectedKecamatan($model->kecamatan_id),
                'options'=>['id'=>'kelurahan-id', 'placeholder'=>'Pilih ...'],
                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                'pluginOptions'=>[
                    'depends'=>['kecamatan-id'],
                    'url' => Url::to(['kelurahan/kelurahan']),
                    'params'=>['kecamatan-1']
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-1">
            <?= $form->field($model, 'rt')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-1">
            <?= $form->field($model, 'rw')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'dusun')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'alamat_sementara')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
