<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaNotarisProses */

$this->title = 'Perbaharui Status Akta';
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-notaris-proses-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
