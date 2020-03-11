<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetilUser */

$this->title = 'Create Detil User';
$this->params['breadcrumbs'][] = ['label' => 'Detil Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detil-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
