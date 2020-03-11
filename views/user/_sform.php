<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
if ($exist != '' and $update != true) {
    echo '<div class="callout callout-danger lead">
    Username "' . $exist . '" telah digunakan. Silahkan gunakan username yang lain. <br>
    </div>
    ';
}

?>
<div class="user-form col-sm-10">

    <?php $form = ActiveForm::begin();
    if ($update == true) {
        echo $form->field($model, 'username')->hiddenInput(['value' => $model->username])->label(false);
    } else {
        echo $form->field($model, 'username')->textInput(['maxlength' => true]);
    }
    if ((strlen($model->password) == 0) or ($exist != '' and $update != true)) {
        echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
        echo $form->field($model, 'password_repeat')->passwordInput(['maxlength' => false]);
    }

    echo $form->field($model, 'nama')->textInput(['value' => $model->nama]);
    echo $form->field($model, 'notaris_id')->hiddenInput(['value' => Yii::$app->user->identity->notaris_id])->label(false);
    echo $form->field($model, 'role')->hiddenInput(['value' => 'staff'])->label(false);

    $model->status = 'Aktif';
    echo $form->field($model, 'status')->radioList([
        'Aktif' => 'Aktif',
        'Non Aktif' => 'Non Aktif',
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Perbaharui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
