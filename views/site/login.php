<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<style>
    .navbar-brand {
        height: 57px;
    }

    .isi-genap {
        color: #EDEDED;
        background-color: #7c7c7c;
        padding: 30px 50px;
    }

    .login_content{
    }

</style>
<container>
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">ONIQS</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#contact">Hubungi Kami</a></li>
                    <li><a href="#signin">Sign in</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-middle">
            <div class="text-center text-center">
                <p>Anda dapat menelusuri proses pengurusan kenotariatan atau PPAT.
                </p>
                <div class="mid_center">
                    <h3>Telusuri Proses</h3>
                    <form>
                        <div class="col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nomor register">
                                <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container isi-genap" id="fitur">
            <!--<div class="heading heading-center">
                <h2>What we do</h2>
                <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
            </div>-->

            <div class="row">
                <div class="col-md-4">
                    <div class="icon-box effect medium border">
                        <!--<div class="icon">
                            <a href="#"><i class="fa fa-plug"></i></a>
                        </div>-->
                        <h3>Dokumen lebih terorganisasi</h3>
                        <p>Anda dapat dengan mudah menelusuri dokumen yang telah dibuat,
                            berdasarkan kriteria yang flexibel.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon-box effect medium border">
                        <h3>Terintegrasi</h3>
                        <p>Klien dapat dengan mudah memeriksa status pengurusan jasa notaris.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon-box effect medium border">
                        <h3>Aman</h3>
                        <p>Semua data setiap data Notaris/PPAT akan dirahasiakan. Data dicadangkan secara berkala.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row" id="signin">
        <div class="login_wrapper">
            <section class="login_content">
                <h1>Sign in</h1>
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

                <?= $form
                    ->field($model, 'username', $fieldOptions1)
                    ->label(false)
                    ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

                <?= $form
                    ->field($model, 'password', $fieldOptions2)
                    ->label(false)
                    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                <div class="row">
                    <div class="col-xs-8">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                    </div>
                    <!-- /.col -->
                </div>

                <?php ActiveForm::end(); ?>


                <div class="separator">
                    <p class="change_link">Ingin mendaftar?
                        <a href="#signup" class="to_register"> Registrasi </a>
                    </p>

                    <div class="clearfix"></div>
                    <br/>

                    <div>
                        <h1><i class="fa fa-paw"></i> ONIQS </h1>
                        <p>©2018 Hak Cipta Fixindo</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</container>

