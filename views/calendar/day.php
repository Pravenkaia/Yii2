<?php
/* @var $this \yii\web\View */
/* @var $model  app\models\Calendar */

use yii\helpers\Url; ?>

<div class="row">

    <div class="col-md-1">
        <a href="<?= Url::to(['day', 'year' => $model->year_before, 'month' => 12, 'day' => 1]); ?>"><<<<<</a>
    </div>
    <div class="col-md-1"><?= $model->year; ?></div>
    <div class="col-md-1">
        <a href="<?= Url::to(['day', 'year' => $model->year_after, 'month' => 1, 'day' => 1]); ?>">>>>>></a>
    </div>

</div>

<div class="row">
    <div class="col-md-1">
        <a href="<?= Url::to(['day', 'year' => $model->year, 'month' => $model->month_before, 'day' => 1]); ?>"><<<<<</a>
    </div>
    <div class="col-md-1"><?= $model->month_name; ?>  </div>
    <div class="col-md-1">
        <a href="<?= Url::to(['day', 'year' => $model->year, 'month' => $model->month_after, 'day' => 1]); ?>">>>>>></a>
    </div>
</div>
<div class="row">
    <div class="col-md-1">
        <a href="<?= Url::to(['day', 'year' => $model->year, 'month' => $model->month, 'day' => $model->day_before]); ?>"><<<<<</a>
    </div>
    <div class="col-md-1"><?= $model->year; ?>-<?= $model->month; ?>-<?= $model->day; ?></div>
    <div class="col-md-1">
        <a href="<?= Url::to(['day', 'year' => $model->year, 'month' => $model->month, 'day' => $model->day_after]); ?>">>>>>></a>
    </div>
</div>


<div class="row" style="display:flex; align-items: stretch; flex-wrap: wrap;">

    <?php
    if ($model->day_activities):
        ?>

        <?php
        foreach ($model->day_activities as $act):
            ?>

            <ul>
                <li>ID: <?= $act['id']; ?></strong></li>
                <li><strong><?= \Yii::t('app', 'Event title'); ?>: <?= $act['title']; ?></strong></li>
                <li><?= \Yii::t('app', 'Event Author'); ?>: <?= $act['author']; ?></li>
                <li><?= \Yii::t('app', 'Start date'); ?>: <?= $act['date_start']; ?></li>
                <li><?= \Yii::t('app', 'Finish date'); ?>: <?= $act['date_end']; ?></li>
            </ul>

        <?php
        endforeach;
        ?>

    <?php
    endif;
    ?>

</div>
