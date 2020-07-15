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

            <div class="col-sm-3">
            <?php
            echo '<label>Tanggal Periode Awal</label>';
            echo DatePicker::widget([
                'model' => $ppat,
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
                'model' => $ppat,
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

    <?= $this->render('..\jenis-lap\ppat\jember-ppat', [
        'model' => $model,
    ]) ?>

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
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>