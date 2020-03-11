<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AktaBadan */

$this->title = 'Tambah Akta Badan Hukum / Usaha';
$this->params['breadcrumbs'][] = ['label' => 'Akta Badans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-badan-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="x_panel">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
