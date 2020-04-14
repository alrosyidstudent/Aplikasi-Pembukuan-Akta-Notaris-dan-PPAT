<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AktaBadanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Pencatatan Akta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-pencatatan-akta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-primary">
        <div class="panel-heading" style="height: 40px;">Daftar Laporan Pencatatan Akta</div>
            <table class="table table-striped table-hover table-condensed" style="margin-top: 20px;">
                <thead>
                            <tr style="height: 35px;">
                                <td width="4%" align="center" valign="middle"><b>#</b></td>
                                <td width="25%" class="align-middle"><b>Periode Bulan</b></td>
                                <td width="64%" class="align-middle"><b>Keterangan</b></td>
                                <td >Detail</td>
                            </tr>    
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                      foreach ($Bulan as $bln) {
                         
                    ?>
                            <tr>
                                <td width="4%" align="center"><?php echo $no; ?></td>
                                <td width="25%" class="align-middle"><?php echo $bln; ?></td>
                                <td width="64%" class="align-middle">Laporan Pencatatan Akta Periode Bulan <?php echo $bln; ?></td>
                                <td ><?= Html::a('Lihat', ['detail'], ['class' => 'btn btn-xs btn-success', 'bln' => $bln]) ?></td>
                            </tr>
                    <?php
                      $no++;
                  }
                    ?>
                </tbody>    
            </table>
        <div class="panel-footer"></div>  
    </div>

</div>


