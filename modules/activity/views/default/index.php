<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:44
 * @var $model \app\models\Activity
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h1> Модульная страница Default (views/default/index)  <?= Html::tag('span', Html::encode($model->title), ['class' => 'heading-name']); ?> </h1>


<?php
$form = \yii\bootstrap\ActiveForm::begin(
    [
        'id' => 'activity',
        'method' => 'POST',
        'options' => ['class' => 'r', 'data_param' => '2']
    ]
);
?>

   $form->action = Url::to(['submit']);
<h2>Введено: <?= Html::encode($model->title); ?></h2>
<p>Ошибки: <?= \yii\helpers\VarDumper::dump($model->arrayErrors); ?></p>
    <?=$form->field($model,'title');?>
    <?=$form->field($model,'description')->textarea(['class'=>'form-control good']);?>
    <?=$form->field($model,'isRepeatable')->checkbox();?>
    <?=$form->field($model,'email');?>


    <div class="form-group">
        <button class="btn btn-default" type="submit">Отправить</button>
    </div>

<div class="form-group">
    <input class="btn btn-default" type="submit" value="Отправить">
</div>

<?php \yii\bootstrap\ActiveForm::end(); ?>

