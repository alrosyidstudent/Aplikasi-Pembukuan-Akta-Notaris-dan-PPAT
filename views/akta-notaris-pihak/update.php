<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisPihak */

$this->title = 'Update Akta Notaris';
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris Pihaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'akta_notaris_id' => $model->akta_notaris_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-notaris-pihak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
