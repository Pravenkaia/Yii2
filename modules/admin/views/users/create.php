<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersBase */

$this->title = Yii::t('app', 'Create Users');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Admin'),
    'url' => ['/admin'] // сама ссылка
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Users'),
    'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
