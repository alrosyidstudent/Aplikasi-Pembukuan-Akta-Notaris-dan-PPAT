<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SuratSifat */
/* @var $form yii\widgets\ActiveForm */
//$id_user=Yii::$app->user->identity->notaris_id;
?>

<div class="surat-sifat-form">

    <?php $form = ActiveForm::begin();
    echo $form->field($model, 'notaris_id')->hiddenInput(['value'=> Yii::$app->user->identity->notaris_id])->label(false);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambahkan' : 'Perbaharui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
