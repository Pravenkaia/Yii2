<?php

/**
 * Created by PhpStorm.
 * User: Talisman
 * Date: 28.01.2019
 * Time: 19:53
 */

/* @var $this \yii\web\View */
?>
<div class="row">
    <div class="col-md-12">
        <pre>
            <?=var_dump($activity_filter)?>
        </pre>
    </div>
    <div class="col-md-12">
        <p>Всего активностей: <strong><?=$cnt?></strong></p>
    </div>
    <div class="col-md-12">
        <h2>Случайная одна активность</h2>
        <pre><?=print_r($any_activity)?></pre>
    </div>
    <div class="col-md-12">
        <h2>Все пользователи</h2>
        <?php foreach ($users as $user):?>
        <p><?=\yii\helpers\ArrayHelper::getValue($user,'email');?></p>
        <?php endforeach;?>
        <pre><?=\yii\helpers\VarDumper::dump($users);?></pre>
    </div>
    <div class="col-md-12">
        <pre>
            <?=print_r($activity_user);?>
        </pre>
    </div>
</div>
