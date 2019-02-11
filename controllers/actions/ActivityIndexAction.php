<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 25.01.2019
 * Time: 13:29
 */

namespace app\controllers\actions;


//use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use yii\base\Action;
use app\models\Activity;


class ActivityIndexAction extends Action
{
    public $settings; //параметры, установки

    /**
     * @return string
     */
    public function run()
    {
        $activity = new Activity();

        if (!\Yii::$app->user->isGuest)
            $activity->id_user = \Yii::$app->user->identity->getId();


        $this->settings = 'Здесь будет список событий';
        if (isset($activity->id_user) && $activity->id_user > 0)
            $activity = \Yii::$app->acts->getUsersActivities($activity->id_user);
        else
            $activity = \Yii::$app->acts->getAllActivities();
        \Yii::$app->view->params['settings'] = $this->settings;

        return $this->controller->render('index', ['model' => $activity]);
    }
}