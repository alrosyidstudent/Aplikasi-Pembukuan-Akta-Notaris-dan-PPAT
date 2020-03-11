<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisJenis */

$this->title = 'Tambah Jenis Akta Umum';
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-notaris-jenis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
