<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SuratSifat */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Surat Sifats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-sifat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Lanjutkan', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Perbaharui', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah anda yakin untuk menghapus item ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            //'notaris_id',
        ],
    ]) ?>

</div>
