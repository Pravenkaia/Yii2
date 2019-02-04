<?php

/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 03.02.2019
 * Time: 21:35
 */

/* @var $this \yii\web\View */
/* @var $model \app\models\Users */
?>
<div class="row">
    <div class="col-md-4">
        <?php $form = \yii\bootstrap\ActiveForm::begin(
            ['id' => 'registration',
                'method' => 'POST']
        ); ?>

        <?=$form->field($model, 'email');?>
        <?=$form->field($model,'username');?>
        <?=$form->field($model,'password');?>



        <div class="form-group">
            <button class="btn btn-default" type="submit">Регистрация</button>
        </div>

        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
