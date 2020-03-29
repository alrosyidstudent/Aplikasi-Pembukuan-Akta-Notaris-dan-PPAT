<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use app\models\akun;



$this->title='Kelola Akun';
$this->params['breadcrubs'][] = $this->title;
 ?>
 <div class="akun">
 	<h1><?= Html::encode($this->title) ?></h1>
 	<?php ?>
 </div>

 	<p>
        <?= Html::a('Tambah Akun Baru', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Atur Akun', ['update'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel panel-primary">
		<div class="panel-heading"></div>
	
	  		<div class="x_panel">
	  			AKun
			</div>
	</div>