<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpat */
/* @var $modelsPihak array|mixed */

$this->title = 'Update Akta Ppat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-ppat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
