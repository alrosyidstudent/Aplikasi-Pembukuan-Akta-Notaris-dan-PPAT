<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaPpat */

$this->title = 'Tambah Akta PPAT';
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="x_panel">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
