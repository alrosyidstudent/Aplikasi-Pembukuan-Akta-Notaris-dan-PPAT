<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;



$this->title='Laporan Keuangan';
$this->params['breadcrubs'][] = $this->title;
 ?>
 <div class="laporan-keuangan">
 	<h1><?= Html::encode($this->title) ?></h1>
 	<?php  ?>
 </div>
  <div class="panel panel-primary">
		<div class="panel-heading"></div>
	
	  		<div class="x_panel">
	  			<div class="row">
	  				<div class="col-sm-6">
	  				Laporan Neraca
	  				</div>
	  				<div class="col-sm-6" align="right">
	  					<?= Html::a('Lihat Laporan', ['neraca'], ['class' => 'btn btn-success']) ?>
	  				</div>
	  			</div>

	  			<div class="row">
	  				<div class="col-sm-6">
	  				Laporan Laba Rugi
	  				</div>
	  				<div class="col-sm-6" align="right">
	  					<?= Html::a('Lihat Laporan', ['labarugi'], ['class' => 'btn btn-success']) ?>
	  				</div>
	  			</div>
	  			
			</div>
	</div>