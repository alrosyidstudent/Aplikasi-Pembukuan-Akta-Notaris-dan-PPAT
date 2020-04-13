<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaNotaris */


$this->params['breadcrumbs'][] = ['label' => 'akun', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akun-create">

    <h2>Tambah akun</h2>
  

    <div class="x_panel">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
