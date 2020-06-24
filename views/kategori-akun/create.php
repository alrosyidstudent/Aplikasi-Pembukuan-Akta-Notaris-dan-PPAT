<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KategoriAkun */

$this->title = 'Tambah Kategori Akun';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Akuns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-akun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
