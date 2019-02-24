<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Admin'),
    'url' => ['/admin'] // сама ссылка
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!--
    <p>
        <?= Html::a(Yii::t('app', 'Create Users Base'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'username',
           // 'email:email',
           // 'password_hash',
           // 'token',
           // //'date_created',

            ['attribute' => 'id', 'label' => 'id'],
            ['attribute' => 'username', 'label' => 'User name'],
            ['attribute' => 'authName', 'label' => Yii::t('app', 'Role'), 'value' => 'role.item_name'],
            ['attribute' => 'email', 'label' => Yii::t('app', 'E-mail')],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
