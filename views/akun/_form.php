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

<div class="akun-form">

    <?php $form = ActiveForm::begin([
      
    ]);

        echo $form->field($model, "notaris_id")->hiddenInput(['value' => Yii::$app->user->identity->notaris_id])->label(false);
    ?>


    <div class="row">
        <div class="col-sm-6">

           <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        </div>
    </div>


    <div class="row">        
         <div class="col-sm-6">

            <?= $form->field($model, 'debit')->textInput(['maxlength' => true]) ?>
         </div>
    </div>

<div class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'kredit')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
         <div class="col-sm-6">
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
        </div>
    </div>

    <div class="row">
         <div class="col-sm-6">
           <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>

        </div>
    </div>


             <div class="col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Perbaharui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
    <?php ActiveForm::end(); ?>


</div>
</div>
