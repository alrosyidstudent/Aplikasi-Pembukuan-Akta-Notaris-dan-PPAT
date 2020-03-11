<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatObjek */

$this->title = 'Update Akta Ppat Objek: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppat Objeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'akta_ppat_id' => $model->akta_ppat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akta-ppat-objek-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
