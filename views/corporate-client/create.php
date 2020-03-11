<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CorporateClient */

$this->title = 'Tambah Data Client';
$this->params['breadcrumbs'][] = ['label' => 'Corporate Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corporate-client-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
