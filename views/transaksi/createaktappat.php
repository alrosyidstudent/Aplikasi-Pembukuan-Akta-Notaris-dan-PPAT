<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */

$this->title = 'Tambah Transaksi';
$this->params['breadcrumbs'][] = ['label' => 'Transaksis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-create-akta-ppat">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
