<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Neraca';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="neraca-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Kembali', ['laporan-keuangan/index'], ['class' => 'btn btn-danger']) ?>
    </p>

<div class="tanggal-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-3">
            <?php
            echo '<label>Tanggal Periode Awal</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'tanggalperiodeawal',
                'name' => 'tanggalperiodeawal',
                'value' => date('Y-m-d', strtotime('today')),
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
            echo '<label>Tanggal Periode Akhir</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'tanggalperiodeakhir',
                'name' => 'tanggalperiodeakhir',
                'value' => date('Y-m-d', strtotime('today')),
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
   <button class="btn btn-primary" onclick="print('PDFtoPrint')">Cetak pdf</button>      
  
    
 <?php ActiveForm::end(); ?>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">Laporan Neraca</div>   
      <div class="x_panel" id="PDFtoPrint">

         <table class="table-hover">
            <tr class="success">
                <td style="padding-right: 15px; padding-left: 15px">Tanggal Periode Awal</td>
                <td style="padding-right: 15px; padding-left: 15px">Tanggal Periode Akhir</td>
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

            <!-- Aset Lancar -->
            <tr class="success" align="left" >
                <td class="font-weight-bold">Aset Lancar</td>
                <td></td>
                <td></td>               
            </tr>
            <?php 
            $totalAsetLancar=0;
            foreach ($dataAktivaLancar as $lancar) {
                $totalAsetLancar+=$lancar['debit'];
            ?>
            <tr>                      
                <td><?=$lancar->nama ?></td>
                <td>Rp.<?=$lancar->debit ?>,-</td>
                <td></td>

            </tr>
            <?php  
            }
            ?>
            <tr class="warning">
                <td>TOTAL ASET LANCAR</td>
                <td> </td>
                <td class="font-weight-bold">Rp.<?=$totalAsetLancar?>,- </td>
            </tr>


                     <!-- Aset Tetap -->
                    <tr class="success" align="left" >
                        <td class="font-weight-bold">Aset Tetap</td>
                        <td></td>
                        <td></td>               
                    </tr>
                    <?php 
                    $totalAsetTetap=0;
                    foreach ($dataAktivaTetap as $tetap) {
                        $totalAsetTetap+=$tetap['debit'];
                    ?>
                    <tr>                      
                        <td><?=$tetap->nama ?></td>
                        <td>Rp.<?=$tetap->debit ?>,-</td>
                        <td></td>

                    </tr>
                    <?php  
                    }
                    ?>
                    <tr class="warning">
                        <td class="font-weight-bold">TOTAL ASET TETAP</td>
                        <td> </td>
                        <td class="font-weight-bold">Rp.<?=$totalAsetTetap?>,- </td>
                    </tr>

            <!-- TOTAL AKTIVA -->
            <?php 
            $totalAset=0;
            $totalAset=$totalAsetLancar+$totalAsetTetap;
            ?>
            <tr class="danger">
                <td class="font-weight-bold">TOTAL ASET</td>
                <td></td>
                <td class="font-weight-bold">Rp.<?=$totalAset?>,- </td>
            </tr>


            <!-- Modal -->
            <tr class="success" align="left" >
                <td class="font-weight-bold">Modal</td>
                <td></td>
                <td></td>               
            </tr>
            <?php 
            $totalekuitas=0;
            foreach ($dataEkuitas as $modal) {
                $totalekuitas+=$modal['kredit'];
            ?>
            <tr>                      
                <td><?=$modal->nama ?></td>
                <td>Rp.<?=$modal->kredit ?>,-</td>
                <td></td>

            </tr>
            <?php  
            }
            ?>
            <tr class="warning">
                <td class="font-weight-bold">TOTAL MODAL
                <td> </td>
                <td class="font-weight-bold">Rp.<?=$totalekuitas?>,- </td>
            </tr>


                    <!-- Hutang -->
                    <tr class="success" align="left" >
                        <td class="font-weight-bold">Liabilitas/Hutang</td>
                        <td></td>
                        <td></td>               
                    </tr>
                    <?php 
                    $totalHutang=0;
                    foreach ($dataHutang as $hutang) {
                        $totalHutang+=$hutang['kredit'];
                    ?>
                    <tr>                      
                        <td><?=$hutang->nama ?></td>
                        <td>Rp.<?=$hutang->kredit ?>,-</td>
                        <td></td>

                    </tr>
                    <?php  
                    }
                    ?>
                    <tr class="warning">
                        <td class="font-weight-bold">TOTAL LIABILITAS/HUTANG</td>
                        <td> </td>
                        <td class="font-weight-bold">Rp.<?=$totalHutang?>,- </td>
                    </tr>


                    <!-- TOTAL PASIVA -->
            <?php 
            $totalPasiva=0;
            $totalPasiva=$totalekuitas+$totalHutang;
            ?>
            <tr class="danger">
                <td class="font-weight-bold">TOTAL LIABILITAS DAN MODAL</td>
                <td></td>
                <td class="font-weight-bold">Rp.<?=$totalPasiva?>,- </td>
            </tr>


        </table>
        
    </div>
</div>
</div>
<script type="text/javascript">
function print(elem) {
    var mywindow = window.open('', 'PRINT', 'height=800,width=1000');

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
