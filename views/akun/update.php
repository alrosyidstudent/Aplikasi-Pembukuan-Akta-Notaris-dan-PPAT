<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use app\models\akun;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\date\DatePicker;

$this->title='Atur Akun';
$this->params['breadcrubs'][] = $this->title;
 ?>
 <div class="akun">
 	<h1><?= Html::encode($this->title) ?></h1>
 	<?php  ?>
 </div>
 	<p>
			<?= Html::a('Kembali', ['index'], ['class' => 'btn btn-danger']) ?>
			Silahkan masukkan saldo awal Pertanggal
			<?php
            // echo '<label>Tanggal</label>';
            // echo DatePicker::widget([
            //     'model' => $model,
            //     'attribute' => 'tanggal',
            //     'name' => 'tanggal',
            //     'value' => date('Y-m-d', strtotime('+30 days')),
            //     'options' => ['placeholder' => 'Pilih tanggal'],
            //     'pluginOptions' => [
            //         'format' => 'yyyy-mm-dd',
            //         'autoclose' => true,
            //         'todayHighlight' => true
            //     ]
            // ]);
            ?>
	</p>

    <div class="panel panel-primary">
		<div class="panel-heading"></div>
	
	  		<div class="x_panel">
	  			ini halaman atur akun

	  			<div class="col-sm-12" align="right">
	  				 <?= Html::submitButton('Simpan',['class' => 'btn btn-success'])?>
	  			</div>
			</div>
	</div>


 ?>