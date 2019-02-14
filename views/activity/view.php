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
<?php if($model): ?>
<div class="row">
    <div class="col-md-12">
        <h2><?=$model->title;?></h2>
        <div><span>Дата старта: </span><?=$model->date_start;?></div>
        <div><span>Дата конца: </span><?=$model->date_end;?></div>
        <div><span>Описание: </span><br><?=$model->description;?></div>
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
            'label' => 'Автор',
            'value' => $model->id_user,
            'contentOptions' => ['class' => 'bg-red'],
            'captionOptions' => ['tooltip' => 'Tooltip'],
        ],
        'date_start:datetime',
        'date_end:datetime',
        'date_created:datetime',
        'date_changed:datetime',
    ],
]);
?>