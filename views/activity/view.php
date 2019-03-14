<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 12.02.2019
 * Time: 17:15
 * @var $this \yii\web\View
 * @var app\models\Activity $model
 *
 */

use yii\widgets\DetailView;

?>
<?php if ($model): ?>
    <div class="row">
        <div class="col-md-12">
            <h2><?= $model->title; ?></h2>
            <div><span><?= Yii::t('app','Date start')?>: </span><?= $model->date_start; ?></div>
            <div><span><?= Yii::t('app','Date start: {0, date, dd.MM.yyy}', strtotime($model->date_start))?> (мультиязычность с позиционированием  форматированием)</div>
            <div><span><?= Yii::t('app','Date start: {0}', strtotime($model->date_start))?> (мультиязычность с позиционированием  форматированием)</div>
            <div><span><?= Yii::t('app','Date end')?>: </span><?= $model->date_end; ?></div>
            <div><?= Yii::t('app', 'Description:<br> {description}',['description' =>$model->description])?></div>
            <div><?= Yii::t('app', 'Activity created date: {0} {1}',[$model->date_created,$model->description])?> (мултиязычность с позиционированием)</div>
        </div>
    </div>
<?php endif; ?>


<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'title',
        'description:html',
        [
            'label' => Yii::t('app','Author'),
            'value' => $model->id_user,
            'contentOptions' => ['class' => 'bg-red'],
            'captionOptions' => ['tooltip' => 'Tooltip'],
        ],
        [
            'label' => 'Дата старта (поведение аттачено в контроллере)',
            'value' => $model->getDateFormatted(),
        ],
        'date_start:datetime',
        'date_end:datetime',
        'date_created:datetime',
        'date_changed:datetime',
        'email',
    ],
]);
?>