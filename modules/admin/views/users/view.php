<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsersBase */

$this->title = $model->username . ', id=' .$model->id;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Admin'),
    'url' => ['/admin'] // сама ссылка
];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
yii\web\YiiAsset::register($this);
?>
<div class="users-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'userRole',
            'username',
            'email:email',
            'password_hash',
            'token',
            'date_created',
        ],
    ]) ?>

</div>