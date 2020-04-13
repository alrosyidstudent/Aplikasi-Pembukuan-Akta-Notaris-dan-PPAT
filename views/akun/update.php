<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaNotaris */


$this->params['breadcrumbs'][] = ['label' => 'Transaski', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akun-update">

    <h2>Tambah Transaksi</h2>
    

    <div class="x_panel">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
