<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 12.02.2019
 * Time: 17:15
 * @var $this \yii\web\View
 * @var app\models\Activity $model
 *
 */
?>

<div class="row">
    <div class="col-md-12">
        <h2><?=$model->title;?></h2>
        <div><span>Дата старта: </span><?=$model->date_start;?></div>
        <div><span>Дата конца: </span><?=$model->date_end;?></div>
        <div><span>Описание: </span><br><?=$model->description;?></div>
    </div>
</div>
