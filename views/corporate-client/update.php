<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CorporateClient */

$this->title = 'Perbaharui Data Client: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Corporate Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="corporate-client-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
