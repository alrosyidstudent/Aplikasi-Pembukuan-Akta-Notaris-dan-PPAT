<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use app\models\akun;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

$this->title='Tambah Akun';
$this->params['breadcrubs'][] = $this->title;
 ?>
 <div class="akun">
 	<h1><?= Html::encode($this->title) ?></h1>
 	<?php  ?>
 </div>

    <div class="panel panel-primary">
		<div class="panel-heading"></div>
	
	  		<div class="x_panel">

	  			<?= $this->render('_form', [
            	'model' => $model,
        		]) ?>
			</div>
	</div>

 ?>