<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JenisLap */

$this->title = 'Create Jenis Lap';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Laps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-lap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
