<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SuratSifat */

$this->title = 'Tambah Sifat Surat';
$this->params['breadcrumbs'][] = ['label' => 'Surat Sifats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-sifat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
