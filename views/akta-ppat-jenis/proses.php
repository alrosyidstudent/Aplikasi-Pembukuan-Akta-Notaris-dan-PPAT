<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanJenis */

$this->title = 'Perbaharui Tahapan Pengurusan Akta '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-jenis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_proses', [
        'model' => $model,
        'modelsProses' => $modelsProses,
    ]) ?>

</div>
