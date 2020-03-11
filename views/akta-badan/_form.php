<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadan */
/* @var $form yii\widgets\ActiveForm */
//echo "<pre>";
//print_r($model);
//echo "</pre>";
?>

<div class="x_title">
    <h2>Data Akta
    </h2>
    <div class="clearfix"></div>
</div>
<div class="akta-badan-form">

    <?php $form = ActiveForm::begin();

    echo $form->field($model, "notaris_id")->hiddenInput(['value' => Yii::$app->user->identity->notaris_id])->label(false);
    ?>
    <div class="row">
        <div class="col-sm-3">
            <?php
            echo $form->field($model, 'akta_badan_jenis_id')->widget(Select2::classname(), [
                'data' => \app\models\AktaBadanJenis::getOptions(),
            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            if(isset($model->akta_badan_jenis_sifat_id)){
                echo Html::hiddenInput('sifat-1', $model->akta_badan_jenis_sifat_id, ['id'=>'sifat-1']);
            }
            echo $form->field($model, 'akta_badan_jenis_sifat_id')->widget(DepDrop::classname(), [
                'type'=>DepDrop::TYPE_SELECT2,
                'data' => \app\models\AktaBadanJenisSifat::getSifatSelectedJenis($model->akta_badan_jenis_id),
                'options'=>['id'=>'akta-badan-jenis-sifat-id', 'placeholder'=>'Pilih ...'],
                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                'pluginOptions'=>[
                    'depends'=>['aktabadan-akta_badan_jenis_id'],
                    'url' => Url::to(['/akta-badan-jenis-sifat/sifat']),
                    'params'=>['sifat-1']
                ]
            ]);
            ?>
        </div>
        <div class="col-sm-3">
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
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'nomor')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo $form->field($model, 'user_id')->widget(Select2::classname(), [
                'data' => \app\models\DetilUser::getOptions(),
                'options' => ['placeholder' => 'Pilih Staff'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo $form->field($model, 'corporate_client_id')->widget(Select2::classname(), [
                'data' => \app\models\CorporateClient::getOptions(),
                'options' => ['placeholder' => 'Pilih Client'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>
    <br>
    <h2>Tempat Kedudukan</h2>
    <div class="ln_solid"></div>
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
                    'depends'=>['aktabadan-provinsi_id'],
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
    <div class="row">

    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Perbaharui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
