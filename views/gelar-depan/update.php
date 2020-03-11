<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GelarDepan */

$this->title = 'Update Gelar Depan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gelar Depans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gelar-depan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
