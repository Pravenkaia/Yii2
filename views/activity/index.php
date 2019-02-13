<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:44
 */
/* @var $model \app\models\Activity */
/* @var $this \yii\web\View */


//use yii\helpers\Url;
use \yii\helpers\VarDumper;
use yii\grid\GridView;


?>

<div class="row">
    <h2 class="h2">
        <?= \Yii::$app->view->params['settings']; ?>
        <?php
        if (!Yii::$app->user->isGuest)
            echo 'Пользователь id: ' . (Yii::$app->user->identity->getId());
        ?>
    </h2>
</div>

<?php
if (isset($provider))
    echo GridView::widget([
        'dataProvider' => $provider,
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            $class = $index % 2 ? 'odd' : 'even';
            return ['class' => $class];
        },
        'layout' => "{pager}\n{items}\n{summary}\n{pager}\n",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'id',
                'attribute' => 'id_activity',
                'value' => function ($data) {
                    return $data->id_activity;
                }
            ],
            [
                'label' => 'user',
                'attribute' => 'id_user',
                'value' => function ($data) {
                    return $data->id_user;
                }
            ],
            [
                'label' => 'Название',
               //'attribute' => 'title',
               //'value' => function ($data) {
               //    return $data->title;
               //}
                //работает
                'value' => function ($model) {
                    return \yii\helpers\Html::a(
                            \yii\helpers\Html::encode($model->title),
                            ['activity/view', 'id' => $model->id_activity]);
                },
                'format' => 'raw'
            ],
            [
                'label' => 'Дата начала',
                'attribute' => 'date_start',
                'value' => function ($data) {
                    return date("d.m.Y", strtotime($data->date_start));
                },
            ],
            [
                'label' => 'Дата завершения',
                'attribute' => 'date_end',
                'value' => function ($data) {
                    return date("d.m.Y", strtotime($data->date_end));
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

?>






<?php
//if (isset($model))echo '<pre>';  VarDumper::dump($model); echo '</pre>';
?>





