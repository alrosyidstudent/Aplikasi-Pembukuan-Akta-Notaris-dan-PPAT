<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use app\models\transaksi;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\Select2;



$this->title='Transaksi Pengeluaran';
$this->params['breadcrubs'][] = $this->title;
 ?>
 <div class="transaksi">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php  ?>
 </div>
    <p>
      <?= Html::a('Pemasukan', ['index'], ['class' => 'btn btn-success']) ?>

      <?= Html::a('Tambah Transaksi', ['create2'], ['class' => 'btn btn-success']) ?>
    </p>

<div class="panel panel-primary">
    <div class="panel-heading">List Pengeluaran</div>
    
      <div class="x_panel">
         <table class="table table-hover">
            <tr class="success" align="center">
                <td>No</td>
                <td>Tanggal</td>
                <td>Jenis Transaksi</td>
                <td>Nominal</td>
                <td>Keterangan</td>
                <td>Aksi</td>

                

            </tr>
            <?php 
            $no=1;
            foreach ($dataTransaksi as $transaksi) {
                # code...
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?=$transaksi->tanggal ?></td>
                     <td><?=$transaksi->labelJenis() ?></td>
                    <td>Rp.<?=$transaksi->nominal ?>,-</td>
                    <td><?=$transaksi->keterangan ?></td>
                    <td align="center"> 
                        <?= Html::a('Hapus', ['delete2', 'id' => $transaksi->id], [
                         'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Apakah anda yakin akan menghapus transaksi ini?',
                                'method' => 'post',
                                    ],
                                ]) ?>
                             <?= Html::a('Perbaharui', ['update2', 'id' => $transaksi->id], ['class' => 'btn btn-primary']) ?>
                    </td>
                </tr>
            <?php 
            $no++;
            }
            ?>

        </table>
    </div>
</div>




