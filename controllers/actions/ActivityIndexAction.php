<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 25.01.2019
 * Time: 13:29
 */

namespace app\controllers\actions;


//use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use app\behaviors\InsertLogBehavior;
use Yii;
use yii\base\Action;
use app\models\Activity;
use yii\data\ActiveDataProvider;


class ActivityIndexAction extends Action
{
    public $settings; //параметры, установки

    /**
     * @return string
     */
    public function run()
    {

        /** @var string $this */
        $this->settings = 'Список событий';
        Yii::$app->view->params['settings'] = $this->settings;

        if (Yii::$app->user->isGuest) :
            //$activity->id_user = \Yii::$app->user->identity->getId();
            $error = 'Only authorized users can view the activities list';
            Yii::$app->session->setFlash('error', $error);
            return $this->controller->render('error', ['error' => $error]);
        else:

            Yii::$app->attachBehavior('myLog',['class' => InsertLogBehavior::class]);


            if (Yii::$app->request->get('id_activity') > 0) {  //выбрано событие
                $activity = Activity::findOne(Yii::$app->request->get('id_activity'));

                if ($activity->id_user == Yii::$app->user->id
                    || Yii::$app->user->can('admin')) {
                    return $this->controller->render('view', ['model' => $activity]);
                } else {
                    Yii::$app->session->setFlash('error', 'Доступ запрещен!');
                    return $this->controller->render('error', ['error' => 'Доступ запрещён']);
                }
            } else { //все события
                if (Yii::$app->user->can('admin'))
                    $query = Activity::find(); //->orderBy('date_start')->all();
                else
                    $query = Activity::find()->where(['id_user' => Yii::$app->user->identity->getId()]); //->orderBy('date_end')->all();


                $activitiesProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => [
                        'pageSize' => 3,
                    ],
                    'sort' => [
                        'defaultOrder' => [
                            'date_start' => SORT_DESC,
                        ]
                    ],
                ]);


                $activity = $activitiesProvider->getModels();

                return $this->controller->render('index', ['provider' => $activitiesProvider]);
            }


        endif;

        //if (isset($activity->id_user) && $activity->id_user > 0)
        //    $activity = \Yii::$app->acts->getUsersActivities($activity->id_user);
        //else
        //    $activity = \Yii::$app->acts->getAllActivities();

        //return $this->controller->render('index', ['model' => $activity]);
    }
}