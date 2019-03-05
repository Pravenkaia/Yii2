<?php
/* @var $this \yii\web\View */
/* @var $model  app\models\Calendar */

?>
<div class="row">
    <div class="col-md-1">
        <a href="?year=<?= $model->year_before; ?>&month=12"><<<<<</a>
    </div>
    <div class="col-md-1"><?= $model->year; ?></div>
    <div class="col-md-1">
        <a href="?year=<?= $model->year_after; ?>&month=1">>>>>></a>
    </div>
</div>

<div class="row">
    <div class="col-md-1">
        <a href="?month=<?= $model->month_before; ?>&year=<?= $model->year; ?>"><<<<<</a>
    </div>
    <div class="col-md-1"><?= $model->month_name; ?></div>
    <div class="col-md-1">
        <a href="?month=<?= $model->month_after; ?>&year=<?= $model->year; ?>">>>>>></a>
    </div>
</div>

<div class="row" style="display:flex; align-items: stretch; flex-wrap: wrap;">
    <?php
    foreach ($model->days as $the_day):
        ?>
        <div class='col-md-2' style="border:thin solid grey; margin: 4px; ">
            <a href="calendar/day/?month=<?= $model->month; ?>&year=<?= $model->year; ?>&day=<?= $the_day['day_number']; ?>"><?= $the_day['day_number']; ?> <br>(<?= $the_day['day_of_week']; ?>)</a>
            <?php
            if ($the_day['activities']):
                ?>
                <ul>
                    <?php
                    foreach ($the_day['activities'] as $act):
                        ?>
                        <li>id=<?= $act['id']; ?>. <strong><?= $act['title']; ?></strong>,(<?= $act['author']; ?>)</li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            <?php
            endif;
            ?>
        </div>
    <?php
    endforeach;
    ?>
</div>
