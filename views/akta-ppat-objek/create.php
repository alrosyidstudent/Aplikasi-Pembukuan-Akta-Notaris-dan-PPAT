<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaPpatObjek */

$this->title = 'Create Akta Ppat Objek';
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppat Objeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-objek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
