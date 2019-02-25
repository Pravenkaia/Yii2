<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 02.02.2019
 * Time: 12:18
 */

/* @var $this Yii\web\View */
/* @var $users app\models\Users */
/* @var $auth app\models\AuthItems */
/* @var $activities app\models\Activity */
/* @var $cnt app\models\Activity */
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper; ?>

<div class="row">

    <h2>auth_item</h2>
    <pre>

                <?= VarDumper::dump($auth); ?>
     </pre>
</div>

<div class="row">

    <h2>Все пользователи</h2>
</div>

<div class="container">
    <?php foreach ($users as $user): ?>
        <div class="col-md-4"><?= ArrayHelper::getValue($user, 'id') . ': ' . ArrayHelper::getValue($user, 'email');; ?></div>
    <?php endforeach; ?>
</div>
<div class="row">
            <pre>

                <?= VarDumper::dump($users); ?>
         </pre>
</div>


<div class="row">
    <h2>Все события (пользователя 1) <?php echo $cnt; ?></h2>
</div>
<div class="container">
    <?php foreach ($activities as $activity): ?>
        <div class="col-md-4">
            Юзер ID: <?= ArrayHelper::getValue($activity, 'id'); ?>
            <br>Юзер: <?= ArrayHelper::getValue($activity, 'username'); ?>, <?= ArrayHelper::getValue($activity, 'email'); ?>
            <br>Событие: <?= ArrayHelper::getValue($activity, 'title'); ?>
            <br><?= ArrayHelper::getValue($activity, 'date_start'); ?>
            <br><br>
        </div>
    <?php endforeach; ?>
</div>
<div class="row"><pre>

               <?= VarDumper::dump($activities); ?>
            </pre>
</div>





