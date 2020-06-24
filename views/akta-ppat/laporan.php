<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Pencatatan Akta PPAT';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-laporan">

    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="tanggal-form">
	<?php $form = ActiveForm::begin(); ?>
	<div class="row">
            <div class="col-sm-3">
            <?php
            echo '<label>Tanggal Periode Awal</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'tanggalawal',
                'name' => 'tanggalawal',
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
                'attribute' => 'tanggalakhir',
                'name' => 'tanggalakhir',
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
	<button class="btn btn-success" onclick="exportTableToExcel('tblData')">Export Excel</button>
	<button class="btn btn-warning" onclick="print('PDFtoPrint')">Versi Cetak</button>
    <?php ActiveForm::end(); ?>
</div>
<div class="row" id="PDFtoPrint">
    <div class="class=col-sm-6">
        <table border="1" class="table table-striped table-bordered" id="tblData">
        	<thead style="background-color: #1ab7ee; color: white;">
        		<tr align="center" >
	        		<td rowspan="5">No</td>
	        		<td colspan="2">Akta</td>
	        		<td rowspan="5">Bentuk Pembuatan Hukum</td>
	        		<td rowspan="2">PIHAK YANG MENGALIHKAN</td>
	        		<td rowspan="2">PIHAK YANG MENERIMA</td>
	        		<td rowspan="5">JENIS DAN NO.HAK</td>
	        		<td rowspan="3">LETAK TANAH</td>
	        		<td colspan="2">LUAS</td>
	        		<td rowspan="5">HARGA TRANSAKSI</td>
	        		<td colspan="2">SPPT PBB</td>
	        		<td colspan="2">SSP</td>
	        		<td colspan="2">SSB</td>
	        		<td rowspan="5">Keterangan</td>
        		</tr>
        		<tr>
        			<td rowspan="4">Nomor</td>
        			<td rowspan="4">Tanggal</td>
        			<td rowspan="4">Tanah (m2)</td>
        			<td rowspan="4">Bangunan (m2)</td>
        			<td rowspan="4">NJOP/ TAHUN</td>
        			<td rowspan="4">NJOP (Rp)</td>
        			<td rowspan="4">Tanggal</td>
        			<td rowspan="4">(Rp)</td>
        			<td rowspan="4">Tanggal</td>
        			<td rowspan="4">(Rp)</td>
        		</tr>
        		<tr>
        			<td>a. Nama</td>
        			<td>a. Nama</td>
        		</tr>
        		<tr>
        			<td>b. Alamat</td>
        			<td>b. Alamat</td>
        			<td>a. Desa/Kel</td>
        		</tr>
        		<tr>
        			<td>c. NPWP/NIK</td>
        			<td>c. NPWP/NIK</td>
        			<td>b. Kecamatan</td>
        		</tr>
        	</thead>
        	<tbody>
        		<?php foreach ($dataAktaPpat as $aktappat) {
        		?>
        			<tr>
	        			<td rowspan="3">
	        				<?php 
	        				$a = 1;
	        				echo $a++;
	        				 ?>

	        			</td>
	        			<td rowspan="3"><?= $aktappat->nomor ?></td> <!-- nomor akta -->
	        			<td rowspan="3"><?= $aktappat->tanggal ?></td> 
	        			<td rowspan="3">-</td> <!-- bentuk hukum -->
	        			<td>Parto</td> <!--  nama pihak yang mengalihkan -->
	        			<td>Joko</td> <!-- nama pihak yang menerima -->
	        			<td rowspan="3"><?= $aktappat->akta_ppat_jenis_id ?></td> <!-- jenis akta -->
	        			<td><?= $aktappat->kelurahan_id ?></td> <!-- kelurahan badan-->
	        			<td rowspan="3"><?= $aktappat->luas_tanah ?></td> <!-- luas tanah -->
	        			<td rowspan="3"><?= $aktappat->luas_bangunan ?></td> <!-- luas bangunan -->
	        			<td rowspan="3"></td> <!-- harga transaksi -->
	        			<td rowspan="3"></td> <!-- NJOP tahun -->
	        			<td rowspan="3"></td> <!-- NJOP (Rp) -->
	        			<td rowspan="3"><?= $aktappat->ssp_tanggal ?></td> <!-- tanggal ssp -->
	        			<td rowspan="3"><?= $aktappat->ssp_nilai ?></td> <!-- nilai ssp -->
	        			<td rowspan="3">28 Januari 2014</td> <!-- tanggal sspd -->
	        			<td rowspan="3">50000</td> <!-- nilai sspd -->
	        			<td rowspan="3"> </td> <!-- keterangan -->
	        		</tr>
	        		<tr>
	        			<td>Jl Ikan Sadar</td> <!-- alamat pengalih -->
	        			<td>jl Ikan Paus</td> <!-- alamat penerima -->
	        			<td rowspan="2">Banyuwangi</td> <!-- kecamatan badan -->
	        		</tr>
	        		<tr>
	        			<td>18738513470</td> <!-- NPWP pengalih -->
	        			<td>71238056783</td> <!-- NPWP penerima -->
	        		</tr>
	        	<?php } ?>
        	</tbody>
</table>
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

<!-- fungsi untuk export laporan kedalam excel -->
<script type="text/javascript">
	function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>