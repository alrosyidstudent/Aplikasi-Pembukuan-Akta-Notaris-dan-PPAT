<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use kartik\form\ActiveForm;
 ?>
<div class="akta-ppat-laporan">


	<div class="tanggal-form">
	    <?php $form = ActiveForm::begin(); ?>
	    <div class="row">
	            
	    </div>
	    <?= Html::submitButton('Filter', ['class' => 'btn btn-primary']) ?> 
	    <button class="btn btn-success" onclick="tableToExcel('testTable', 'W3C Example Table')">Export Excel</button>
	    <button class="btn btn-warning" onclick="print('PDFtoPrint')">Versi Cetak</button>
	    <?php ActiveForm::end(); ?>
	</div>
	<div class="row" id="PDFtoPrint">
	    <div class="class=col-sm-6">
	        <table id="testTable" border="1px" cellspacing="0" class="table table-bordered border border-dark">
	            <thead style="background-color: #1ab7ee; color: white; font-weight: bold;">
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
	                    <td rowspan="2">NJOP Tanah (Rp)</td>
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
	                    <td rowspan="2">NJOP Bangunan (Rp)</td>
	                </tr>
	                <tr>
	                    <td>c. NPWP/NIK</td>
	                    <td>c. NPWP/NIK</td>
	                    <td>b. Kecamatan</td>
	                </tr>
	            </thead>
	            <tbody>
	                <?php 
	                $a=1;
	                foreach ($model as $aktappat) {
	                ?>
	                    <tr>
	                        <td rowspan="3">
	                           <?php 
	                            echo $a++;
	                             ?>

	                        </td>
	                        <td rowspan="3"> <?= $aktappat->nomor ?> </td> <!-- nomor akta -->
	                        <td rowspan="3"><?= $aktappat->tanggal ?></td> <!-- tanggal akta -->
	                        <td rowspan="3">-</td> <!-- bentuk hukum -->
	                        <td><? foreach ($dataPihak as $ppatpihak) {
	                            echo $ppatpihak->nama; 
	                        } ?></td> <!--  nama pihak yang mengalihkan -->
	                        <td>Joko</td> <!-- nama pihak yang menerima -->
	                        <td rowspan="3"><?= $aktappat->Jenis ?></td> <!-- jenis akta -->
	                        <td><?= $aktappat->kelurahanName ?></td> <!-- kelurahan badan-->
	                        <td rowspan="3"><?= $aktappat->luas_tanah ?></td> <!-- luas tanah -->
	                        <td rowspan="3"><?= $aktappat->luas_bangunan ?></td> <!-- luas bangunan -->
	                        <td rowspan="3"></td> <!-- harga transaksi -->
	                        <td rowspan="3"><?= $aktappat->njop_tahun ?></td> <!-- NJOP tahun -->
	                        <td rowspan=""> <?= $aktappat->njop_tanah ?></td> <!-- NJOP tanah (Rp) -->
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
	                        <td rowspan="2"><?= $aktappat->njop_bangunan ?></td>
	                    </tr>
	                    <tr>
	                        <td>18738513470</td> <!-- NPWP pengalih -->
	                        <td>71238056783</td> <!-- NPWP penerima -->
	                    </tr>
	                <?php
	                 } 
	                 ?>
	            </tbody>
			</table>
	    </div>
	</div>
</div>


