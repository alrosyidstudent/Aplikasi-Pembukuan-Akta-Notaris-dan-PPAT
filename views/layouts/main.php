<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

//use yii\helpers\Html;
//use app\models\User;

//$bundle = yiister\gentelella\assets\Asset::register($this);

?>
<?php $this->beginPage();

if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {
    require_once("main-app.php");
}
$this->endPage(); ?>
