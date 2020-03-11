<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kembali', ['cindex'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Perbaharui', ['cupdate', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*= Html::a('Hapus', ['cdelete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'username',
            'ccName',
            'ccAlamat',
            'notarisName',
            'status',
        ],
    ]) ?>

</div>
