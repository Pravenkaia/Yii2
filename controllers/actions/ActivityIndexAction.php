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
     *  определяем свою (НЕ переопределяем)
     */
    public function run()
    {
        $activity = new Activity();



        $this->settings = 'Здесь будет список событий';

        $activity = \Yii::$app->dao->getAllActivities();

        \Yii::$app->view->params['settings'] = $this->settings ;

        return $this->controller->render('index', ['model' => $activity]);
    }
}