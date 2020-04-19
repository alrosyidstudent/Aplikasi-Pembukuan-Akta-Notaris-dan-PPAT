<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Laba Rugi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laba-rugi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kembali', ['laporan-keuangan/index'], ['class' => 'btn btn-success']) ?>
    </p>

<div class="panel panel-primary">
    <div class="panel-heading">Laporan Laba Rugi</div>   
      <div class="x_panel">


        <table class="table table-hover">

            <!-- Pendapatan -->
            <tr class="success" align="left" >
                <td>Pendapatan</td>
                <td>Nominal</td>
                <td></td>               
            </tr>
            <?php 
            $total=0;
            foreach ($dataPendapatan as $pendapatan) {
                $total+=$pendapatan['nominal'];
            ?>
            <tr>                      
                <td><?=$pendapatan->keterangan ?></td>
                <td>Rp.<?=$pendapatan->nominal ?>,-</td>
                <td></td>

            </tr>
            <?php  
            }
            ?>
            <tr class="warning">
                <td>TOTAL PENDAPATAN</td>
                <td> </td>
                <td>Rp.<?=$total?>,- </td>
            </tr>


                    <!-- Biaya Operasional -->
                    <tr class="success" align="left" >
                        <td>Biaya Operasional</td>
                        <td>Nominal</td>
                        <td></td>
                    </tr>
                    <?php 
                    $total2=0;           
                    foreach ($dataBiayaOperasional as $operasional) {
                         $total2+=$operasional['nominal'];
                         
                        ?>
                    <tr style="padding-left: px">                      
                        <td><?=$operasional->keterangan ?></td>
                        <td>Rp.<?=$operasional->nominal ?>,-</td>
                        <td></td>        
                    </tr>
                    <?php  
                    }
                    ?>

                    <tr class="warning">
                        <td>TOTAL BIAYA OPERASIONAL</td>
                        <td> </td>
                        <td>Rp.<?=$total2?>,- </td>
                    </tr>


            <!-- Laba Kotor -->
            <?php 
            $total3=0;
            $total3=$total-$total2;
            ?>
            <tr class="warning">
                <td>LABA BERSIH BIAYA OPERASIONAL</td>
                <td> </td>
                <td>Rp.<?=$total3?>,- </td>
            </tr>


                    <!-- Biaya Keluar Lainnya -->
                    <tr class="success" align="left" >
                        <td>Biaya Keluar Lainnya</td>
                        <td>Nominal</td>    
                        <td></td>           
                    </tr>
                    <?php 
                    $totalbiayalain=0;
                    foreach ($dataBiayaLainnya as $biayalain) {
                        $totalbiayalain+=$biayalain['nominal'];
                    ?>
                    <tr>                      
                        <td><?=$biayalain->keterangan ?></td>
                        <td>Rp.<?=$biayalain->nominal ?>,-</td>
                        <td></td>

                    </tr>
                    <?php  
                    }
                    ?>
                    <tr class="warning">
                        <td>TOTAL BIAYA LAINNYA</td>
                        <td> </td>
                        <td>Rp.<?=$totalbiayalain?>,- </td>
                    </tr>


                    <!-- Pendapatan Lainnya -->
                    <tr class="success" align="left" >
                        <td>Pendapatan Lainnya</td>
                        <td>Nominal</td>    
                        <td></td>           
                    </tr>
                    <?php 
                    $totalpendapatanlain=0;
                    foreach ($dataPendapatanLainnya as $pendapatanlain) {
                        $totalpendapatanlain+=$pendapatanlain['nominal'];
                    ?>
                    <tr>                      
                        <td><?=$pendapatanlain->keterangan ?></td>
                        <td>Rp.<?=$pendapatanlain->nominal ?>,-</td>
                        <td></td>

                    </tr>
                    <?php  
                    }
                    ?>
                    <tr class="warning">
                        <td>TOTAL PENDAPATAN LAINNYA</td>
                        <td> </td>
                        <td>Rp.<?=$totalpendapatanlain?>,- </td>
                    </tr>

            <!-- LAba Bersih -->
            <?php 
            $lababersih=0;
            $lababersih=$total3+$totalpendapatanlain-$totalbiayalain;
            ?>
            <tr class="success">
                <td>LABA BERSIH</td>
                <td> </td>
                <td>Rp.<?=$lababersih?>,- </td>
            </tr>

        </table>
 
    </div>
</div>






</div>
