<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AktaBadan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akta-notaris-form">

    <?php $form = ActiveForm::begin();

    echo $form->field($model, "notaris_id")->hiddenInput(['value' => Yii::$app->user->identity->notaris_id])->label(false);
    ?>
    <div class="row">
        <div class="col-sm-6">
            <?php
                echo $form->field($model, 'akta_notaris_jenis_id')->widget(Select2::classname(), [
                    'data' => \app\models\AktaNotarisJenis::getOptions(),
                    'id' => 'akta-notaris-jenis-id',
                    'options' => ['placeholder' => 'Pilih..'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
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
        <div class="col-sm-6">
            <?= $form->field($model, 'nomor')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
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
        <div class="col-sm-6">
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
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Perbaharui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
