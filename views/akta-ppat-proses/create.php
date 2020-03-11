<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatProses */

$this->title = 'Perbaharui Status/Proses';
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppat Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-proses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
