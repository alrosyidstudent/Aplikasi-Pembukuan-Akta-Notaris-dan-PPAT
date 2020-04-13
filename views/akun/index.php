<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use app\models\Akun;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\Select2;



$this->title='kelola akun';
$this->params['breadcrubs'][] = $this->title;
 ?>
 <div class="akun">
 	<h1><?= Html::encode($this->title) ?></h1>
 	<?php  ?>
 </div>
	<p>
     

       <?= Html::a('Tambah akun', ['create'], ['class' => 'btn btn-success']) ?>
    
    </p>
    
     

<div class="panel panel-primary">
    <div class="panel-heading">List Pemasukan</div>   
      <div class="x_panel">
    
        <table class="table table-bordered table-hover">
            <tr class="success" align="center">
                <td>nama</td>
                <td>debit</td>
                <td>kredit</td>
                <td>Keterangan</td>
                <td>Aksi</td>

                

            </tr>
            <?php 
            foreach ($dataAkun as $akun) {
                # code...
                ?>
                <tr>
                    <td><?=$akun->nama ?></td>
                     <td><?=$akun->debit ?></td>
                    <td>Rp.<?=$akun->kredit ?>,-</td>
                    <td><?=$akun->ket ?></td>
                    <td align="center"> 
                        <?= Html::a('Hapus', ['delete', 'id' => $akun->id], [
                         'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Apakah anda yakin akan menghapus akun ini?',
                                'method' => 'post',
                                    ],
                                ]) ?>
                             <?= Html::a('Perbaharui', ['update', 'id' => $akun->id], ['class' => 'btn btn-primary']) ?>
                    </td>
                </tr>
            <?php 
            }
            ?>

        </table>

    </div>
</div>

