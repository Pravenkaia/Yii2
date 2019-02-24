<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActivityBase */

$this->title = Yii::t('app', 'Update Activity Base: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Admin'),
    'url' => ['/admin'] // сама ссылка
];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activity Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id_activity]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="activity-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
