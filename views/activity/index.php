<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:44
 * @var $model \app\models\Activity
 */
use yii\helpers\Url;
use \yii\helpers\VarDumper;

?>

<div class="row">
    <h2 class="h2">
        <?=\Yii::$app->view->params['settings']; ?>
        <?php
        echo 'Пользователь id: ';
        if(!Yii::$app->user->isGuest) echo (Yii::$app->user->identity->getId());
        ?>
    </h2>
</div>

<div class="row">
<?php
  echo '<pre>' . VarDumper::dump($model) . '</pre>';
 ?>

</div>



