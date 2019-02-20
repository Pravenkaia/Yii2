<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
/* @var $roles array app\models\AuthItems */
?>

<?php
/**
 *  опции к dropDownlist()
 * @var array $params
 */
$params = [
    //'prompt' => Yii::t('app', 'Choose the role'),
    'options' =>[ $model->userRole => ['Selected' => true]] //    'options' =>[  => ['Selected' => true]] //

];

?>
<?=$model->userRole;?>



<div class="users-base-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'userRole')->dropDownList($roles, $params); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
