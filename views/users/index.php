<?php

/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 08.02.2019
 * Time: 17:57
 */

/* @var $this \yii\web\View  */
/* @var $model  app\models\UsersUpdate */
?>

<div class="row">
    <h2>Привет <?= $model->username; ?></h2>
</div>

<div class="row">
    <h4><?=Yii::t('app', 'User Account'); ?></h4>
    <div class="col-md-4">
        <?php $form = \yii\bootstrap\ActiveForm::begin(
            ['id' => 'registration',
                'method' => 'POST']
        ); ?>

        <?=$form->field($model, 'email');?>
        <?=$form->field($model,'username');?>
        <?=$form->field($model,'password');?>
        <?=$form->field($model,'new_password');?>



        <div class="form-group">
            <button class="btn btn-default" type="submit"><?=Yii::t('app', 'Save changes'); ?></button>
        </div>

        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>

