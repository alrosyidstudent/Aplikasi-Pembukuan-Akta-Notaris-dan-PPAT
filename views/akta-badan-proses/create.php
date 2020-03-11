<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaBadanProses */

$this->title = 'Perbaharui Status/Proses';
$this->params['breadcrumbs'][] = ['label' => 'Akta Badan Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-proses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
