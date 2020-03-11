<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanJenisSifat */
$akta=\app\models\AktaBadanJenis::find()
    ->where(['id'=>$model->akta_badan_jenis_id])->one();
$this->title = 'Tambah Sifat Akta '.$akta->name;
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Jenis Sifats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-jenis-sifat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
