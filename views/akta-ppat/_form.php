<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpat */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="x_title">
    <h2>Data Akta
    </h2>
    <div class="clearfix"></div>
</div>

<div class="akta-ppat-form">

    <?php $form = ActiveForm::begin();
    echo $form->field($model, "notaris_id")->hiddenInput(['value' => Yii::$app->user->identity->notaris_id])->label(false);
    ?>
    <div class="row">
        <div class="col-sm-2">
            <?php
            echo $form->field($model, 'akta_ppat_jenis_id')
                ->dropDownList(\app\models\AktaPpatJenis::getOptions(), [
                    'id' => 'akta-ppat-jenis-id',
                    'prompt' => 'Pilih...'
                ]);
            ?>
        </div>
        <div class="col-sm-2">
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
        <div class="col-sm-2">
            <?= $form->field($model, 'nomor')->textInput(['maxlength' => true]) ?>
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
    <h2>Kedudukan Objek</h2>
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
                    'depends'=>['aktappat-provinsi_id'],
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

    <br>
    <h2>Data Pajak</h2>
    <div class="ln_solid"></div>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'nop')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?php
            echo $form->field($model, 'nilai_pengalihan')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => 'Rp. ',
                    'allowNegative' => false,
                    'precision' => 0
                ]
            ]);
            ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'luas_tanah')->textInput() ?>
        </div>
        <div class="col-sm-2">
            <?php
            echo $form->field($model, 'njop_tanah')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => 'Rp. ',
                    'allowNegative' => false,
                    'precision' => 0
                ]
            ]);
            ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'luas_bangunan')->textInput() ?>
        </div>
        <div class="col-sm-2">
            <?php
            echo $form->field($model, 'njop_bangunan')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => 'Rp. ',
                    'allowNegative' => false,
                    'precision' => 0
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <?php
            echo '<label>Tanggal SSP</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'ssp_tanggal',
                'name' => 'ssp_tanggal',
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
            <?= $form->field($model, 'ssp_nilai')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo '<label>Tanggal SSPD</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'sspd_tanggal',
                'name' => 'sspd_tanggal',
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
            <?= $form->field($model, 'sspd_nilai')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambahkan' : 'Perbaharui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
