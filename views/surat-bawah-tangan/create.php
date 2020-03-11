<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SuratBawahTangan */

$this->title = 'Tambah Surat Bawah Tangan';
$this->params['breadcrumbs'][] = ['label' => 'Surat Bawah Tangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-bawah-tangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPihak' => $modelsPihak,
    ]) ?>

</div>
