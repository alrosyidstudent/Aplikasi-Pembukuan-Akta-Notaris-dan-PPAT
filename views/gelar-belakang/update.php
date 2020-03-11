<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GelarBelakang */

$this->title = 'Update Gelar Belakang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gelar Belakangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gelar-belakang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
