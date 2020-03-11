<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaNotaris */

$this->title = 'Tambah Akta Umum';
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-notaris-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="x_panel">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
