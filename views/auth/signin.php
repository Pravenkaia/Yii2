<?php

/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 04.02.2019
 * Time: 11:33
 */

/* @var $this \yii\web\View */
/* @var $model \app\models\Users */

?>
<div class="row">
  <h4>Авторизация</h4>
    <div class="col-md-4">
        <?php $form = \yii\bootstrap\ActiveForm::begin(
            ['id' => 'authorisation',
                'method' => 'POST']
        ); ?>

        <?= $form->field($model, 'email'); ?>
        <?= $form->field($model, 'password'); ?>


        <div class="form-group">
            <button class="btn btn-default" type="submit">Авторизация</button>
        </div>

        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
