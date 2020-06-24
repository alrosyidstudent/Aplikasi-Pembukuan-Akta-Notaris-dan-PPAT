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
   <button class="btn btn-warning" onclick="print('PDFtoPrint')">Cetak pdf</button>  
    <?= Html::a('Kembali', ['laporan-keuangan/index'], ['class' => 'btn btn-danger']) ?>    
  
    
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
                <td>Total</td>               
            </tr>
            <?php 
            $totalAsetLancar=0;
            foreach ($dataAktivaLancar as $lancar) {
                $totalAsetLancar+=$lancar['debit'];
            ?>
            <tr>                      
                <td><?=$lancar->nama ?></td>
                <td>Rp. <?=number_format($lancar->debit, 0, ".", ".")?>,00</td>
                <td></td>

            </tr>
            <?php  
            }
            ?>
            <tr class="warning">
                <td>TOTAL ASET LANCAR</td>
                <td> </td>
                <td class="font-weight-bold">Rp. <?=number_format($totalAsetLancar, 0, ".", ".")?>,00</td>
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
                        <td>Rp. <?=number_format($tetap->debit, 0, ".", ".")?>,00</td>
                        <td></td>

                    </tr>
                    <?php  
                    }
                    ?>
                    <tr class="warning">
                        <td class="font-weight-bold">TOTAL ASET TETAP</td>
                        <td> </td>
                        <td class="font-weight-bold">Rp. <?=number_format($totalAsetTetap, 0, ".", ".")?>,00 </td>
                    </tr>


                    <!-- Depresiasi -->
                    <tr class="success" align="left" >
                        <td class="font-weight-bold">Depresiasi</td>
                        <td></td>
                        <td></td>               
                    </tr>
                    <?php 
                    $TotalDepresiasi=0;
                    foreach ($dataDepresiasi as $depresiasi) {
                        $TotalDepresiasi+=$depresiasi['nominal'];
                    ?>
                    <tr>                      
                        <td><?=$depresiasi->keterangan ?></td>
                        <td>( Rp. <?=number_format($depresiasi->nominal, 0, ".", ".")?>,00 )</td>
                        <td></td>

                    </tr>
                    <?php  
                    }
                    ?>
                    <tr class="warning">
                        <td class="font-weight-bold">TOTAL DEPRESIASI</td>
                        <td> </td>
                        <td class="font-weight-bold">( Rp. <?=number_format($TotalDepresiasi, 0, ".", ".")?>,00 )</td>
                    </tr>




            <!-- TOTAL AKTIVA -->
            <?php 
            $totalAset=0;
            $totalAset=($totalAsetLancar+$totalAsetTetap)-$TotalDepresiasi;
            ?>
            <tr class="danger">
                <td class="font-weight-bold" style="color: blue">TOTAL ASET</td>
                <td></td>
                <td class="font-weight-bold" style="color: blue">Rp. <?=number_format($totalAset, 0, ".", ".")?>,00 </td>
            </tr>


            <!-- Modal -->
            <tr class="success" align="left" >
                <td class="font-weight-bold">Modal</td>
                <td></td>
                <td></td>               
            </tr>
            <?php 
            $totalmodal=0;
            foreach ($dataEkuitas as $modal) {
                $totalmodal+=$modal['kredit'];
            ?>
            <tr>                      
                <td><?=$modal->nama ?> (Kredit)</td>
                <td>Rp. <?=number_format($modal->kredit, 0, ".", ".")?>,00</td>
                <td></td>

            </tr>

            <?php  
            }
            ?>
             <?php 
            $totalmodal2=0;
            foreach ($dataEkuitas as $modal) {
                $totalmodal2+=$modal['debit'];
            ?>
            <tr>                      
                <td><?=$modal->nama ?> (Debit)</td>
                <td>( Rp. <?=number_format($modal->debit, 0, ".", ".")?>,00 )</td>
                <td></td>

            </tr>
            
            <?php  
            }
            ?>
            <?php 
            $totalmodal3=0;
            $totalmodal3=$totalmodal-$totalmodal2;
             ?>
            <tr class="warning">
                <td class="font-weight-bold">TOTAL MODAL
                <td> </td>
                <td class="font-weight-bold">Rp. <?=number_format($totalmodal3, 0, ".", ".")?>,00 </td>
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
                        <td> Rp. <?=number_format($hutang->kredit, 0, ".", ".")?>,00</td>
                        <td></td>

                    </tr>
                    <?php  
                    }
                    ?>
                    <tr class="warning">
                        <td class="font-weight-bold">TOTAL LIABILITAS/HUTANG</td>
                        <td> </td>
                        <td class="font-weight-bold"> Rp. <?=number_format($totalHutang, 0, ".", ".")?>,00 </td>
                    </tr>


                    <!-- TOTAL PASIVA -->
            <?php 
            $totalPasiva=0;
            $totalPasiva=$totalmodal3+$totalHutang;
            ?>
            <tr class="danger">
                <td class="font-weight-bold" style="color: blue">TOTAL LIABILITAS DAN MODAL</td>
                <td></td>
                <td class="font-weight-bold" style="color: blue"> Rp. <?=number_format($totalPasiva, 0, ".", ".")?>,00 </td>
            </tr>

       

        </table>
        
    </div>



                <!-- Pesan jika tidak balance -->
            <div>
                
                 <table class="table table-hover">
                
                 <?php if ($totalAset!=$totalPasiva) {
                    # code...
                 ?>    
                 <?php 
                 $selisih=0;
                 $selisih=$totalAset-$totalPasiva;
                 $selisih2=0;
                 $selisih2=$totalPasiva-$totalAset;
                ?>
                <tr class="danger">
                    <td style="color: red">     
                          Periksa kembali data Akun anda, Total Aset dengan Total Liabailitas dan Modal tidak Balance   
                    </td>       
                </tr>
                <tr class="danger">
                    <td style="color: red">Total Aset adalah Rp. <?=number_format($totalAset, 0, ".", ".")?>,00</td>
                </tr>
                <tr class="danger">
                    <td style="color: red">Total Liabilitas dan Modal adalah Rp. <?=number_format($totalPasiva, 0, ".", ".")?>,00</td>
                </tr>
                <tr class="danger">

                    <td style="color: red">
                    <?php if ($totalAset>$totalPasiva): ?>
                        Buat Akun Ekuitas Modal dan tambahkan selisih sebesar Rp. <?=number_format($selisih, 0, ".", ".")?>,00 pada kredit?
                         <br><br><?= Html::a('Tambahkan', ['akun/createkredit','nama'=>'Ekuitas Modal','kredit'=>$selisih], ['class' => 'btn btn-primary']) ?>
                    <?php endif ?>

                    <?php if ($totalAset<$totalPasiva): ?>
                        Buat Akun Ekuitas Modal dan tambahkan selisih sebesar Rp. <?=number_format($selisih2, 0, ".", ".")?>,00 pada debit?
                         <br><br><?= Html::a('Tambahkan', ['akun/createdebit','nama'=>'Ekuitas Modal','debit'=>$selisih2], ['class' => 'btn btn-primary']) ?>
                    <?php endif ?>
                       
                    </td>
                </tr>
                
                
                <?php 
                }else{
                } ?>    
                </table>

                    
            </div>
</div>
</div>


<!-- fungsi untuk mencetak laporan ke dalam pdf -->
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
