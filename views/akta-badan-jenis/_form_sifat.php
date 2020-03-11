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
        jQuery(this).html("Sifat: ke-" + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Sifat: ke- " + (index + 1))

    });
});
';

$this->registerJs($js);

$capability_list = array(
    '1'=>'Awareness',
    '2'=>'Abble to do',
    '3'=>'Master',
    '4'=>'Able to traing others',
);
?>

    <div class="training-form">
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="panel panel-default col-sm-8">
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 20, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $modelsSifat[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'staff_id',
                            'score'
                        ],
                    ]); ?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i> Sifat akta
                            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i
                                        class="fa fa-plus"></i> Tambah Sifat Akta
                            </button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body container-items"><!-- widgetContainer -->
                            <?php foreach ($modelsSifat as $index => $modelSifat): ?>
                                <div class="item panel panel-default"><!-- widgetBody -->
                                    <div class="panel-heading">
                                        <span class="panel-title-address">Sifat: ke- <?= ($index + 1) ?></span>
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
                                        if (!$modelSifat->isNewRecord) {
                                            echo $form->field($modelSifat, "[{$index}]id")->hiddenInput(['value' => $modelSifat->id])->label(false);
                                            //echo $form->field($modelSifat, "[{$index}]training_training_types_id")->hiddenInput(['value' => $modelSifat->training_training_types_id])->label(false);
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?= $form->field($modelSifat, "[{$index}]name")
                                                    ->textInput(['maxlength' => true])->label(false) ?>
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
            <?= Html::submitButton($modelSifat->isNewRecord ? 'Simpan' : 'Update', ['class' => 'btn btn-warning']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
