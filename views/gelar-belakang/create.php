<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GelarBelakang */

$this->title = 'Create Gelar Belakang';
$this->params['breadcrumbs'][] = ['label' => 'Gelar Belakangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gelar-belakang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
