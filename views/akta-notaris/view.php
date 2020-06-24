<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\AktaNotaris */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Akta Notaris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('Index', ['index'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Perbaharui', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Apakah anda yakin akan menghapus akta ini?',
            'method' => 'post',
        ],
    ]) ?>
    <?= Html::a('Tambah Pihak', ['akta-notaris-pihak/create', 'akta_notaris_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Update Proses', ['akta-notaris-proses/create', 'akta_notaris_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Biaya Masuk/Keluar', ['transaksi/createaktanotaris','akta_notaris_id' => $model->id], ['class' => 'btn btn-primary']) ?>

</p>
<div class="row">
    <div class="col-sm-6">
        <div class="akta-notaris-view">
            <h3>Detil Akta</h3>


            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'nomor',
                    'tanggal',
                    'jenis',
                    'register',
                    'clientName',
                    'pic',
                ],
            ]) ?>

        </div>
    </div>
    <div class="col-sm-6">
        <h3>Proses</h3>
        <table id="w0" class="table table-striped table-bordered">
            <thead style="background-color: #1ab7ee; color: white">
            <td>Tahapan</td>
            <td>Keterangan</td>
            </thead>
            <?php
            $proseses = \app\models\AktaNotarisProses::find()->where(['akta_notaris_id' => $model->id])->all();
            foreach ($proseses as $proses) {
                ?>
                <tr>
                    <td><?= $proses->aktaNotarisJenisProses->deskripsi ?></td>
                    <td><?= $proses->keterangan ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
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
            $pihaks = \app\models\AktaNotarisPihak::find()->where(['akta_notaris_id' => $model->id])->all();
            $no = 0;
            foreach ($pihaks

                     as $pihak) {
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
                            ['/akta-notaris-pihak/update'], [
                                'data-method' => 'POST',
                                'data-params' => [
                                    'id' => $pihak->id,
                                    'akta_notaris_id' => $model->id,
                                ],
                            ]) ?>
&nbsp;
                        <?= Html::a('<span class="fa fa-trash" aria-hidden="true"></span> ',
                            ['/akta-notaris-pihak/delete'], [
                                'data-method' => 'POST',
                                'data-params' => [
                                    'id' => $pihak->id,
                                    'akta_notaris_id' => $model->id,
                                ],
                            ]) ?>
                    </td>
                </tr>
            <?php }
            ?>
        </table>
    </div>
</div>




