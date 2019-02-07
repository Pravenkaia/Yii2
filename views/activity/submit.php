<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 28.01.2019
 * Time: 17:07
 */



?>


 <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>


<?php
//$errors = $model->arrayErrors;
//if ($errors)  :
//    foreach ($errors as $error):
//     echo '<p>' . $error . '</p>';
//    endforeach;
//endif;
?>


<h2>Введено: <?=
    $model->title; ?></h2>
<h2>id: <?= $model->id_user; ?></h2>
<h2>title: <?= $model->title; ?></h2>
<h2>Файлы загружены: <?= $model->document; ?></h2>
