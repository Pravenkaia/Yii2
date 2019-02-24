<?php

use app\models\Activity;
/**
 * @var $model Activity
 */
?>

<h2>Грядущая активность</h2>
<h3><?=$model->title;?></h3>
<p>Дата начала: <?=$model->date_start?></p>
<p>
    <?=$model->description;?>
</p>