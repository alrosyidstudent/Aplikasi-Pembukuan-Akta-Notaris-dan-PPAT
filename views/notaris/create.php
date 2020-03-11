<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Notaris */

$this->title = 'Create Notaris';
$this->params['breadcrumbs'][] = ['label' => 'Notaris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notaris-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
