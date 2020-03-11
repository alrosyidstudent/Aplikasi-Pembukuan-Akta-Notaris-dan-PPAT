<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AktaPpat */

$this->title = $model->jenis . ', No. ' . $model->nomor;
$this->params['breadcrumbs'][] = ['label' => 'Akta Ppats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akta-ppat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Index', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Tambah Pihak', ['akta-ppat-pihak/create', 'akta_ppat_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update Proses', ['akta-ppat-proses/create', 'akta_ppat_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="row">
        <h3>Detil Akta</h3>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <table id="w0" class="table table-striped table-bordered">
                <tr>
                    <td><b>Alamat</b></td>
                    <td><?php
                        if ($model->alamat != '') {
                            echo $model->alamat . ', ';
                        }
                        echo $model->rt . ', ' .
                            $model->rw . ', ' .
                            $model->dusun . ', ' .
                            $model->kelurahanName . ', ' .
                            $model->kecamatanName;
                        echo '<br>' . $model->kabupatenName . ', ' .
                            $model->provinsiName;
                        ?></td>
                </tr>

                <tr>
                    <td><b>Luas Tanah</b></td>
                    <td><?= $model->luas_tanah ?></td>
                </tr>
                <tr>
                    <td><b>Luas Bangunan</b></td>
                    <td><?= $model->luas_bangunan ?></td>
                </tr>
                <tr>
                    <td><b>Nilai Pengalihan</b></td>
                    <td><?= $model->nilai_pengalihan ?></td>
                </tr>
                <tr>
                    <td><b>Client</b></td>
                    <td><?= $model->clientName ?></td>
                </tr>
                <tr>
                    <td><b>PIC</b></td>
                    <td><?= $model->pic ?></td>
                </tr>

            </table>
        </div>
        <div class="col-sm-6">
            <table id="w0" class="table table-striped table-bordered">
                <tr>
                    <td><b>NOP</b></td>
                    <td><?= $model->nop ?></td>
                </tr>
                <tr>
                    <td><b>NJOP Tanah</b></td>
                    <td><?= $model->njop_tanah ?></td>
                </tr>
                <tr>
                    <td><b>NJOP Bangunan</b></td>
                    <td><?= $model->njop_bangunan ?></td>
                </tr>
                <tr>
                    <td><b>SSP</b></td>
                    <td>Tangggal. <?= $model->ssp_tanggal ?>, Rp. <?= $model->ssp_nilai ?></td>
                </tr>
                <tr>
                    <td><b>SSPD</b></td>
                    <td>Tangggal. <?= $model->sspd_tanggal ?>, Rp. <?= $model->sspd_nilai ?></td>
                </tr>

                <tr>
                    <td><b>No Register</b></td>
                    <td><?= $model->register ?></td>
                </tr>

            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h3>Para Pihak</h3>
        <table id="w0" class="table table-striped table-bordered">
            <thead style="background-color: #1ab7ee; color: white">
            <td rowspan="2">Pihak Ke-</td>
            <td rowspan="2">Nama</td>
            <td rowspan="2">Selaku</td>
            <td colspan="8">Mulai</td>
            <td rowspan="2">Aksi</td>
            </thead>
            <thead style="background-color: #1ab7ee; color: white">
            <td></td>
            <td></td>
            <td></td>
            <td>Alamat</td>
            <td>RT</td>
            <td>RW</td>
            <td>Dusun</td>
            <td>Kelurahan</td>
            <td>Kecamatan</td>
            <td>Kabupaten</td>
            <td>Provinsi</td>
            <td></td>
            </thead>
            <?php
            $pihaks = \app\models\AktaPpatPihak::find()->where(['akta_ppat_id' => $model->id])->all();
            $no = 0;
            foreach ($pihaks as $pihak) {
                $no++;
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $pihak->nama ?></td>
                    <td><?= $pihak->selaku ?></td>
                    <td><?= $pihak->alamat ?></td>
                    <td><?= $pihak->rt ?></td>
                    <td><?= $pihak->rw ?></td>
                    <td><?= $pihak->dusun ?></td>
                    <?php
                    $kelurahan = \app\models\Kelurahan::findOne($pihak->kelurahan_id);
                    $kecamatan = \app\models\Kecamatan::findOne($kelurahan->kecamatan_id);
                    $kabupaten = \app\models\Kabupaten::findOne($kecamatan->kabupaten_id);
                    $provinsi = \app\models\Provinsi::findOne($kabupaten->provinsi_id);
                    ?>
                    <td><?= $kelurahan->nama ?></td>
                    <td><?= $kecamatan->nama ?></td>
                    <td><?= $kabupaten->nama ?></td>
                    <td><?= $provinsi->nama ?></td>
                    <td>
                        <?= Html::a('<span class="fa fa-pencil" aria-hidden="true"></span> ',
                            ['/akta-ppat-pihak/update'], [
                                'data-method' => 'POST',
                                'data-params' => [
                                    'id' => $pihak->id,
                                    'akta_ppat_id' => $model->id,
                                ],
                            ]) ?>
                        &nbsp;
                        <?= Html::a('<span class="fa fa-trash" aria-hidden="true"></span> ',
                            ['/akta-ppat-pihak/delete'], [
                                'data-method' => 'POST',
                                'data-params' => [
                                    'id' => $pihak->id,
                                    'akta_ppat_id' => $model->id,
                                ],
                            ]) ?>
                    </td>
                </tr>
            <?php }
            ?>
        </table>
    </div>
</div>

