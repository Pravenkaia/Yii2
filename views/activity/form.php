<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 06.02.2019
 * Time: 15:25
 */
/* @var $this \yii\web\View */

/* @var $model \app\models\Activity */

use yii\helpers\Url;


?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success'); ?>
        </div>
<?php endif; ?>


<div class="row">
    <h2 class="h2">
        Ввод и сохранение события
    </h2>
    <h2><?php echo 'Пользователь id: ';
    if (!Yii::$app->user->isGuest) echo(Yii::$app->user->identity->getId());
    ?>
    </h2>
    <h2 class="h2">
        <?php if (isset(\Yii::$app->view->params['settings'])) echo \Yii::$app->view->params['settings']; ?>
    </h2>
</div>

<?php
if (Yii::$app->user->isGuest) : //пользователь не авторизован, или имеет разрешение гостя
    ?>

    <div class="row">
        <p>
            <strong>
                Добавлять и редактировать события могут только авторизованные пользователи
            </strong>
        </p>
    </div>

<?php

else :  //

    $form = \yii\bootstrap\ActiveForm::begin(
        [
            //'id' => 'activity',
            'method' => 'POST',
            'options' => ['class' => 'r', 'data_param' => '2', 'enctype' => 'multipart/form-data',],
            'action' => 'submit'
        ]
    );
    ?>


    <?php if (isset($model->id_activity)) { // редактирование ?>
    <?= $form->field($model, 'id_activity')->hiddenInput(); ?>
<?php }; ?>


    <?= $form->field($model, 'title'); ?>

    <?= $form->field($model, 'date_start')->widget("kartik\date\DatePicker", [
    'name' => 'date_start',
    'options' => ['placeholder' => 'Выберите дату начала события'],
    'convertFormat' => true,
    'pluginOptions' => [
        'format' => 'yyyy-MM-dd',
        'todayHighlight' => true
    ]
])->label($model->getAttributeLabel('Дата начала события. date_start')) ?>

    <?= $form->field($model, 'date_end')->widget("kartik\date\DatePicker", [
    'name' => 'date_end',
    'options' => ['placeholder' => 'Выберите дату окончания события'],
    'convertFormat' => true,
    'pluginOptions' => [
        'format' => 'yyyy-MM-dd',
        'todayHighlight' => true
    ]
])->label($model->getAttributeLabel('date_end')) ?>



    <?= $form->field($model, 'description')->textarea(['class' => 'form-control good']); ?>
    <?= $form->field($model, 'is_repeatable')->checkbox(); ?>
    <?= $form->field($model, 'is_blocking')->checkbox(); ?>
    <?= $form->field($model, 'email'); ?>
    $form->field($model, 'document_file')->fileInput(['accept' => 'application/pdf']);
    $form->field($model, 'picture')->fileInput(['multiple' => true, 'accept' => 'image/*']);

    <div class="form-group">
        <button class="btn btn-default" type="submit">Отправить</button>
    </div>


    <?php \yii\bootstrap\ActiveForm::end(); ?>

<?php endif; ?>
