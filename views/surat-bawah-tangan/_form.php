<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\SuratBawahTangan */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Peserta: ke-" + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Peserta: ke- " + (index + 1))

    });
});
';

$this->registerJs($js);

$kelurahan_list = array(
    '1' => 'Awareness',
    '2' => 'Abble to do',
    '3' => 'Master',
    '4' => 'Able to traing others',
);
?>

<div class="surat-bawah-tangan-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']);

    echo $form->field($model, 'notaris_id')->hiddenInput(['value' => Yii::$app->user->identity->notaris_id])->label(false);
    ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'surat_sifat_id')
                ->dropDownList(
                    ArrayHelper::map(
                        \app\models\SuratSifat::find()
                            ->where(['notaris_id' => Yii::$app->user->identity->notaris_id])
                            ->all(),
                        'id', 'name'),
                    ['prompt' => 'Pilih Sifat Surat']
                )->label(false) ?>
        </div>
        <div class="col-sm-6">
            <?= Html::a('Tambah Jenis Surat', ['surat-sifat/create', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
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
            echo "<br>";
            ?>
        </div>
        <div class="col-sm-4">
            <?php
            echo $form->field($model, 'nomor_urut')->textInput(['maxlength' => true]);

            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <b>Jenis</b>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'jenis')->radioList([
                'Disahkan' => 'Legalisasi (Disahkan);',
                'Dibukukan' => 'Warmerking (Dibukukan)',
            ])->label(false) ?>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default col-sm-10">
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 50, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsPihak[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'staff_id',
                        'score'
                    ],
                ]); ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> Pihak
                        <button type="button" class="pull-right add-item btn btn-success btn-xs"><i
                                    class="fa fa-plus"></i> Tambah Pihak
                        </button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body container-items"><!-- widgetContainer -->
                        <?php foreach ($modelsPihak as $index => $modelPihak): ?>
                            <div class="item panel panel-default"><!-- widgetBody -->
                                <div class="panel-heading">
                                    <span class="panel-title-address">Pihak: ke- <?= ($index + 1) ?></span>
                                    <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i
                                                class="fa fa-minus"></i></button>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="panel-body">
                                    <?php
                                    /*echo '<pre>';
                                    print_r($modelPeserta);
                                    echo '</pre>';*/
                                    // necessary for update action.
                                    if (!$modelPihak->isNewRecord) {
                                        echo $form->field($modelPihak, "[{$index}]id")->hiddenInput(['value' => $modelPihak->id])->label(false);
                                        //echo $form->field($modelPeserta, "[{$index}]training_training_types_id")->hiddenInput(['value' => $modelPeserta->training_training_types_id])->label(false);
                                        //echo $form->field($modelPeserta, "[{$index}]staff_bagian_id")->hiddenInput(['value' => $modelPeserta->staff_bagian_id])->label(false);
                                        //echo Html::activeHiddenInput($modelPeserta, "[{$index}]training_id");
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?= $form->field($modelPihak, "[{$index}]nama")
                                                ->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($modelPihak, "[{$index}]alamat")
                                                ->textInput(['maxlength' => true]) ?>
                                        </div>



                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <?= $form->field($modelPihak, "[{$index}]kelurahan_id")
                                                ->dropDownList(
                                                    $kelurahan_list
                                                ) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelPihak, "[{$index}]dusun")
                                                ->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelPihak, "[{$index}]rt")
                                                ->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelPihak, "[{$index}]rw")
                                                ->textInput(['maxlength' => true]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambahkan' : 'Perbaharui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
