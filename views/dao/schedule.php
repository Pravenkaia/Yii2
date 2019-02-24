<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 03.02.2019
 * Time: 10:16
 */
?>

<div class="container">
<div class="row">
        <h2>Все события</h2>
</div>
        <?php foreach ($activities as $activity): ?>
            <div class="col-md-4"><?= \yii\helpers\ArrayHelper::getValue($activity, 'id') . ': ' . \yii\helpers\ArrayHelper::getValue($activity, 'email');; ?></div>
        <?php endforeach;?>
        <pre>

                <?=\yii\helpers\VarDumper::dump($activities); ?>
            </pre>
    </div>
</diV>
</div>
