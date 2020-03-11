<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisJenisProses */

$this->title = 'Create Akta Notaris Jenis Proses';
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris Jenis Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-notaris-jenis-proses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
