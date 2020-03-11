<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GelarDepan */

$this->title = 'Create Gelar Depan';
$this->params['breadcrumbs'][] = ['label' => 'Gelar Depans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gelar-depan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
