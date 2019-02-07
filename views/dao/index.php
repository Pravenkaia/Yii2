<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 02.02.2019
 * Time: 12:18
 */

/* @var $this Yii\web\View */


?>

<div class="row">

    <h2>auth_item</h2>
    <pre>

                <?= \yii\helpers\VarDumper::dump($auth); ?>
     </pre>
</div>

<div class="row">

    <h2>Все пользователи</h2>
</div>

<div class="container">
    <?php foreach ($users as $user): ?>
        <div class="col-md-4"><?= \yii\helpers\ArrayHelper::getValue($user, 'id') . ': ' . \yii\helpers\ArrayHelper::getValue($user, 'email');; ?></div>
    <?php endforeach; ?>
</div>
<div class="row">
            <pre>

                <?= \yii\helpers\VarDumper::dump($users); ?>
         </pre>
</div>


<div class="row">
    <h2>Все события (пользователя 1) <?php echo $cnt; ?></h2>
</div>
<div class="container">
    <?php foreach ($activities as $activity): ?>
        <div class="col-md-4">
            Юзер ID: <?= \yii\helpers\ArrayHelper::getValue($activity, 'id'); ?>
            <br>Юзер: <?= \yii\helpers\ArrayHelper::getValue($activity, 'username'); ?>, <?= \yii\helpers\ArrayHelper::getValue($activity, 'email'); ?>
            <br>Событие: <?= \yii\helpers\ArrayHelper::getValue($activity, 'title'); ?>
            <br><?= \yii\helpers\ArrayHelper::getValue($activity, 'date_start'); ?>
            <br><br>
        </div>
    <?php endforeach; ?>
</div>
<div class="row"><pre>

               <?=\yii\helpers\VarDumper::dump($activities); ?>
            </pre>
</div>





