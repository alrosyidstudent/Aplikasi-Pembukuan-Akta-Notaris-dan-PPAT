<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use app\model\transaksi;
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
        <?= Html::a('Transaksi Pengeluaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="panel panel-primary">
	<div class="panel-heading"></div>
	
	  <div class="x_panel">
  		<div class="transaksi-form">

  			<div class="col-sm-2">
  				<div class="form-group field-nominal">
  					<label class="control-label" for="nominal-transaksi">Nominal</label>
  					<input class="form-control" type="text" name="transaksi[nominal]" id="nominal-transaksi" maxlength="70">
  					<div class="help-block"></div>
  				</div>
  			</div>

  			<div class="col-sm-3">
  				<label class="control-label" for="Kategori-pemasukan">Kategori Pemasukan</label>
  				<select id="Kategori-pemasukan" class="form-control Select2-hidden-acceseible" name="transaksi[kategori-pemasukan]" >
  					<option value>Pilih Kategori..</option>
  					<option value="1">Pemasukan Terkait Akta</option>
  					<option value="2">Pemasukan Tidak Terkait Akta</option>
  				</select>	
  			</div>

  			<div class="col-sm-2">
  				<label class="control-label" for="Kategori-akun">Kategori Akun</label>
  				<select id="Kategori-akun" class="form-control Select2-hidden-acceseible" name="transaksi[kategori-pemasukan]" >
  					<option value>Pilih Kategori..</option>
  					<option value="1">Kas & Bank</option>
  					<option value="2">Akun Piutang</option>
  					<option value="3">Aktiva Lancar</option>
  					<option value="4">Aktiva Tetap</option>
  					<option value="5">Akun Hutang</option>
  					<option value="6">Kewajiban Lancar Lainnya</option>
  					<option value="7">Kewajiban Jangka Panjang</option>
  					<option value="8">Beban</option>
  					<option value="9">Pendapatan Lainnya</option>
  					<option value="10">Beban Lainnya</option>
  				</select>
  		</div>

  		<div class="col-sm-3">
  			<label>Tanggal</label>
  			<div id="transaksi-tanggal-kvdate" class="input-group  date">
  				<span class="input-group-addon kv-date-calender" title="Pilih Tanggal">
  					
  					<i class="glyphicon glyphicon-calendar"></i>
  					
  				</span>
  				<span class="input-group-addon kv-date-remove" title="Bersihkan Field">

  					<i class="glyphicon glyphicon-remove"></i>

  				</span>
  				<input type="text" name="transaksi[tanggal]" class="form-control krajee-datepicker" id="transaksi-tanggal" placeholder="Pilih Tanggal" data-datepicker-source="transaksi-tanggal-kvdate" data-datepicker-type="2" data-krajee-kvdatepicker="kvDatepicker_535b3809">
  			</div>
  		</div>

  		<div class="col-sm-2">
  				<div class="form-group field-keterangan">
  					<label class="control-label" for="keterangan-transaksi">Keterangan</label>
  					<input class="form-control" type="text" name="transaksi[keterangan]" id="field-keterangan-transaksi" maxlength="70">
  					<div class="help-block"></div>
  				</div>
  			</div>
  </div>
	
</div>

