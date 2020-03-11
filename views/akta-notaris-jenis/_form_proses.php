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
        jQuery(this).html("Proses: ke-" + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Proses: ke- " + (index + 1))

    });
});
';

$this->registerJs($js);

?>

<div class="akta-notaris-jenis-proses-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']);
    ?>
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
                    'model' => $modelsProses[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'staff_id',
                        'score'
                    ],
                ]); ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> Prosess
                        <button type="button" class="pull-right add-item btn btn-success btn-xs"><i
                                    class="fa fa-plus"></i> Tambah Tahapan
                        </button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body container-items"><!-- widgetContainer -->
                        <?php foreach ($modelsProses as $index => $modelProses): ?>
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
                                    if (!$modelProses->isNewRecord) {
                                        echo $form->field($modelProses, "[{$index}]id")->hiddenInput(['value' => $modelProses->id])->label(false);
                                    }
                                    $peringatan_list = array(
                                        'Tidak' => 'Tidak',
                                        'Iya' => 'Iya',
                                    );
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <?= $form->field($modelProses, "[{$index}]deskripsi")
                                                ->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?= $form->field($modelProses, "[{$index}]jangka_waktu")
                                                ->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelProses, "[{$index}]peringatkan")
                                                ->dropDownList(
                                                    $peringatan_list
                                                ) ?>
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
