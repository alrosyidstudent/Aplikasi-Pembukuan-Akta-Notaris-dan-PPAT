<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Laba Rugi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laba-rugi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
       
    </p>

<div class="tanggal-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-3">
            <?php
            echo '<label>Tanggal Awal</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'tanggalawal',
                'name' => 'tanggalawal',
                'value' => date('Y-m-d', strtotime('+30 days')),
                'options' => ['placeholder' => 'Pilih tanggal'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                    'todayHighlight' => true
                    ]
                ]);
           
             ?>
            </div>

        <div class="col-sm-3">   
        <?php
        echo '<label>Tanggal Akhir</label>';
        echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'tanggalakhir',
            'name' => 'tanggalakhir',
            'value' => date('Y-m-d', strtotime('+30 days')),
            'options' => ['placeholder' => 'Pilih tanggal'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
                'todayHighlight' => true
                ]
            ]);      
        ?>
        </div>     
    </div>
  <?= Html::submitButton('Filter', ['class' => 'btn btn-primary']) ?>        
  <button class="btn btn-warning" onclick="print('PDFtoPrint')">Cetak PDF</button>
   <?= Html::a('Kembali', ['laporan-keuangan/index'], ['class' => 'btn btn-danger']) ?>
    
 <?php ActiveForm::end(); ?>
</div>
       
          
</div>
   
<!-- <iframe id="PDFtoPrint"></iframe> -->
<div class="panel panel-primary" >
    <div class="panel-heading">Laporan Laba Rugi</div>   
      <div class="x_panel" id="PDFtoPrint">

        <table class="table-hover">
            <tr class="success">
                <td style="padding-right: 15px; padding-left: 15px">Tanggal Awal</td>
                <td style="padding-right: 15px; padding-left: 15px">Tanggal Akhir</td>
            </tr>

            <tr>
                <td style="padding-right: 15px; padding-left: 15px" align="center"><?=$tgl1 ?></td>
                <td style="padding-right: 15px; padding-left: 15px" align="center"><?=$tgl2 ?></td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>

        <table class="table table-hover">
            <!-- Pendapatan -->
            <tr class="success" align="left" >
                <td class="font-weight-bold">Pendapatan</td>
                <td class="font-weight-bold">Nominal</td>
                <td class="font-weight-bold">Tanggal</td>
                <td class="font-weight-bold">Total</td>               
            </tr>
            <?php 
            $total=0;
            foreach ($dataPendapatan as $pendapatan) {
                $total+=$pendapatan['nominal'];
            ?>
            <tr>                      
                <td><?=$pendapatan->keterangan ?></td>
                <td>Rp. <?=number_format($pendapatan->nominal, 0, ".", ".")?>,00</td>
                <td><?=$pendapatan->tanggal ?></td>
                <td></td>

            </tr>
            <?php  
            }
            ?>
            <tr class="warning">
                <td class="font-weight-bold">TOTAL PENDAPATAN</td>
                <td> </td>
                <td></td>
                <td class="font-weight-bold">Rp. <?=number_format($total, 0, ".", ".")?>,00 </td>
            </tr>


                    <!-- Biaya Operasional -->
                    <tr class="success" align="left" >
                        <td class="font-weight-bold">Biaya Operasional</td>
                        <td class="font-weight-bold">Nominal</td>
                        <td class="font-weight-bold">Tanggal</td>
                        <td></td>
                    </tr>
                    <?php 
                    $total2=0;           
                    foreach ($dataBiayaOperasional as $operasional) {
                         $total2+=$operasional['nominal'];
                         
                        ?>
                    <tr style="padding-left: 0px">                      
                        <td><?=$operasional->keterangan ?></td>
                        <td>( Rp. <?=number_format($operasional->nominal, 0, ".", ".")?>,00 )</td>
                        <td><?=$operasional->tanggal ?></td>
                        <td></td>        
                    </tr>
                    <?php  
                    }
                    ?>  

                    <tr class="warning">
                        <td class="font-weight-bold">TOTAL BIAYA OPERASIONAL</td>
                        <td> </td>
                        <td></td>
                        <td class="font-weight-bold">( Rp. <?=number_format($total2, 0, ".", ".")?>,00 )</td>
                    </tr>


            <!-- Laba bersih operasional -->
            <?php 
            $total3=0;
            $total3=$total-$total2;
            ?>
            <tr class="warning">
                <td class="font-weight-bold">LABA BERSIH BIAYA OPERASIONAL</td>
                <td></td>
                <td></td>
                <td class="font-weight-bold">Rp. <?=number_format($total3, 0, ".", ".")?>,00 </td>
            </tr>


                    <!-- Biaya Keluar Lainnya -->
                    <tr class="success" align="left" >
                        <td class="font-weight-bold">Biaya Keluar Lainnya</td>
                        <td class="font-weight-bold">Nominal</td>    
                        <td class="font-weight-bold">Tanggal</td>  
                        <td></td>           
                    </tr>
                    <?php 
                    $totalbiayalain=0;
                    foreach ($dataBiayaLainnya as $biayalain) {
                        $totalbiayalain+=$biayalain['nominal'];
                    ?>
                    <tr>                      
                        <td><?=$biayalain->keterangan ?></td>
                        <td>( Rp. <?=number_format($biayalain->nominal, 0, ".", ".")?>,00 )</td>
                        <td><?=$biayalain->tanggal ?></td>
                        <td></td>

                    </tr>
                    <?php  
                    }
                    ?>
                    <tr class="warning">
                        <td class="font-weight-bold">TOTAL BIAYA LAINNYA</td>
                        <td></td>
                        <td></td>
                        <td class="font-weight-bold">( Rp. <?=number_format($totalbiayalain, 0, ".", ".")?>,00 )</td>
                    </tr>


                                <!-- Pendapatan Lainnya -->
                                <tr class="success" align="left" >
                                    <td class="font-weight-bold">Pendapatan Lainnya</td>
                                    <td class="font-weight-bold">Nominal</td>    
                                    <td class="font-weight-bold">tanggal</td>  
                                    <td></td>           
                                </tr>
                                <?php 
                                $totalpendapatanlain=0;
                                foreach ($dataPendapatanLainnya as $pendapatanlain) {
                                    $totalpendapatanlain+=$pendapatanlain['nominal'];
                                ?>
                                <tr>                      
                                    <td><?=$pendapatanlain->keterangan ?></td>
                                    <td>Rp. <?=number_format($pendapatanlain->nominal, 0, ".", ".")?>,00</td>
                                     <td><?=$pendapatanlain->tanggal ?></td>
                                    <td></td>

                                </tr>
                                <?php  
                                }
                                ?>
                                <tr class="warning">
                                    <td class="font-weight-bold">TOTAL PENDAPATAN LAINNYA</td>
                                    <td></td>
                                    <td></td>
                                    <td class="font-weight-bold">Rp. <?=number_format($totalpendapatanlain, 0, ".", ".")?>,00 </td>
                                </tr>

            <!-- LAba Bersih -->
            <?php 
            $lababersih=0;
            $lababersih=$total3+($totalpendapatanlain-$totalbiayalain);
            ?>
            <tr class="success">
                <td class="font-weight-bold">LABA BERSIH</td>
                <td></td>
                <td></td>
                <td class="font-weight-bold">Rp. <?=number_format($lababersih, 0, ".", ".")?>,00 </td>
            </tr>

        </table>
    </div>
</div>


<!-- </iframe> -->


</div>
<script type="text/javascript">
function print(elem) {
    var mywindow = window.open('', 'PRINT', 'height=1000,width=1200');

    mywindow.document.write('<html><head><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1 class="center">' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    // mywindow.close();

    return true;

    }
</script>