<?php

/* @var $this \yii\web\View */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use lo\widgets\modal\ModalAjax;
$this->title = 'Demo Widget - Modal';

echo ModalAjax::widget([
    'id' => 'createCompany',
    'header' => 'Create Company',
    'toggleButton' => [
        'label' => 'New Company',
        'class' => 'btn btn-primary pull-right'
    ],
    'url' => Url::to(['/partner/default/create']), // Ajax view with form to load
    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
    // ... any other yii2 bootstrap modal option you need
]);
?>