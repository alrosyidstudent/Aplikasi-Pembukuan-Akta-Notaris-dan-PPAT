<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Depresiasi */

$this->title = 'Tambah Depresiasi';
$this->params['breadcrumbs'][] = ['label' => 'Depresiasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="depresiasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
