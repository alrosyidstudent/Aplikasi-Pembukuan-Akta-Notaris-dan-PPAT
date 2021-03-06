<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\DetailView;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Training */
/* @var $form yii\widgets\ActiveForm */
$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Pihak: ke-" + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Pihak: ke- " + (index + 1))

    });
});
';

$this->registerJs($js);

$selaku_list = array(
    'Mengalihkan'=>'Mengalihkan',
    'Menerima'=>'Menerima',
);

/*echo '<pre>';
print_r($modelsPihak);
echo '</pre>';*/

?>

    <div class="training-form">
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <div class="row">
            <div class="panel panel-default col-sm-12">
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 20, // the maximum times, an element can be cloned (default 999)
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
                            <i class="fa fa-users"></i> Para pihak
                            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i
                                        class="fa fa-plus"></i> Tambah pihak
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
                                        print_r($modelSifat);
                                        echo '</pre>';*/
                                        // necessary for update action.
                                        if (!$modelPihak->isNewRecord) {
                                            echo $form->field($modelPihak, "[{$index}]id")->hiddenInput(['value' => $modelPihak->id])->label(false);
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <?= $form->field($modelPihak, "[{$index}]nama")->textInput(['maxlength' => true]) ?>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <?= $form->field($modelPihak, "[{$index}]selaku")
                                                            ->dropDownList(
                                                                $selaku_list
                                                            ) ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <?= $form->field($modelPihak, "[{$index}]alamat")->textInput(['maxlength' => true]) ?>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <?= $form->field($modelPihak, "[{$index}]rt")->textInput(['maxlength' => true]) ?>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <?= $form->field($modelPihak, "[{$index}]rw")->textInput(['maxlength' => true]) ?>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <?= $form->field($modelPihak, "[{$index}]dusun")->textInput(['maxlength' => true]) ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <?= $form->field($model, "[{$index}]provinsi_id")
                                                            ->dropDownList(\app\models\Provinsi::getOptions(), [
                                                                'id' => 'provinsi-id',
                                                                'prompt' => 'Pilih...'
                                                            ])
                                                        ?>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <?= $form->field($model, "[{$index}]kabupaten_id")->widget(DepDrop::classname(), [
                                                            'options' => ['id' => 'kabupaten-id'],
                                                            'pluginOptions' => [
                                                                'depends' => ['provinsi-id'],
                                                                'placeholder' => 'Pilih...',
                                                                'url' => Url::to(['/kabupaten/kabupaten'])
                                                            ]
                                                        ]) ?>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <?= $form->field($model, "[{$index}]kecamatan_id")->widget(DepDrop::classname(), [
                                                            'options' => ['id' => 'kecamatan-id'],
                                                            'pluginOptions' => [
                                                                'depends' => ['kabupaten-id'],
                                                                'placeholder' => 'Pilih...',
                                                                'url' => Url::to(['/kecamatan/kecamatan'])
                                                            ]
                                                        ]) ?>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <?= $form->field($modelPihak, "[{$index}]kelurahan_id")->widget(DepDrop::classname(), [
                                                            'options' => ['id' => 'kelurahan-id'],
                                                            'pluginOptions' => [
                                                                'depends' => ['kecamatan-id'],
                                                                'placeholder' => 'Pilih...',
                                                                'url' => Url::to(['/kelurahan/kelurahan'])
                                                            ]
                                                        ]) ?>
                                                    </div>
                                                </div>
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

        <!--<div class="form-group">
            <?php //= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>-->
        <div class="form-group">
            <?= Html::submitButton($modelPihak->isNewRecord ? 'Simpan' : 'Update', ['class' => 'btn btn-warning']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
