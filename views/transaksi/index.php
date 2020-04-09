<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use app\models\transaksi;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\Select2;



$this->title='Transaksi Pemasukan';
$this->params['breadcrubs'][] = $this->title;
 ?>
 <div class="transaksi">
 	<h1><?= Html::encode($this->title) ?></h1>
 	<?php  ?>
 </div>
	<p>
      <?= Html::a('Pengeluaran', ['pengeluaran'], ['class' => 'btn btn-success']) ?>

       <?= Html::a('Tambah Transaksi', ['create'], ['class' => 'btn btn-success']) ?>
    
    </p>
    
     

<div class="panel panel-primary">
    <div class="panel-heading">List Pemasukan</div>   
      <div class="x_panel">
    
        <table class="table table-bordered table-hover">
            <tr class="success">
                <td>Tanggal</td>
                <td>Jenis Transaksi</td>
                <td>Nominal</td>
                <td>Keterangan</td>
                <td>Aksi</td>

                

            </tr>
            <?php 
            foreach ($dataTransaksi as $transaksi) {
                # code...
                ?>
                <tr>
                    <td><?=$transaksi->tanggal ?></td>
                     <td><?=$transaksi->labelJenis() ?></td>
                    <td><?=$transaksi->nominal ?></td>
                    <td><?=$transaksi->keterangan ?></td>
                </tr>
            <?php 
            }
            ?>

        </table>

    </div>
</div>

