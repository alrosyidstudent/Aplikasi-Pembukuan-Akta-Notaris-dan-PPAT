<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;



$this->title='Laporan Laba-Rugi';
$this->params['breadcrubs'][] = $this->title;
 ?>
 <div class="laporan-keuangan">
 	<h1><?= Html::encode($this->title) ?></h1>
 	<?php ?>
 </div>
<p><?= Html::a('kembali', ['index'], ['class' => 'btn btn-success']) ?></p>

<div class="panel panel-primary">
	<div class="panel-heading"></div>
	
		<div class="x_panel">
			
		</div>
	
</div>
 	