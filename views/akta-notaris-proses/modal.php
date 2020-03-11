<?php

/* @var $this \yii\web\View */

use yii\bootstrap\Modal;
$this->title = 'Demo Widget - Modal';

?>

<h1>Demo Widget</h1>

<p>Berikut ini contoh penggunaan <i>widget</i> Modal di Yii2:</p>

<?php

Modal::begin([
    'header' => '<h3>Ini adalah judul</h3>',
    'footer' => 'Ini adalah footer',
    'toggleButton' => ['label' => 'klik saya'],
]);

echo 'Ini adalah sebuah modal...';

Modal::end();

?>
