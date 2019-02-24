<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Activity Bases');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Admin'),
    'url' => ['/admin'] // сама ссылка
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Activity Base'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'id_activity', 'label' => 'id_activity'],
            ['attribute' => 'id_user', 'label' => 'id_user'],
            ['attribute' => 'userName', 'label' => Yii::t('app', 'User name'), 'value' => 'users.username'],
            ['attribute' => 'authName', 'label' => Yii::t('app', 'Role'), 'value' => 'auth.item_name'],
            ['attribute' => 'title', 'label' => Yii::t('app', 'Title')],
            ['attribute' => 'date_start', 'label' => Yii::t('app', 'Start date')],
            ['attribute' => 'date_end', 'label' => Yii::t('app', 'End date')],


            ////'is_repeatable',
            ////'is_blocking',
            ////'date_created',
            ////'date_changed',
            ////'description:ntext',
            ////'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
