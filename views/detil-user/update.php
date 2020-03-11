<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetilUser */

$this->title = 'Update Detil User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detil Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detil-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
