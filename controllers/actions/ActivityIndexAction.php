<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 25.01.2019
 * Time: 13:29
 */

namespace app\controllers\actions;


use app\models\Activity;
use yii\base\Action;

class ActivityIndexAction extends Action
{
    public $setting; //параметры, установки
    /**
     *  определяем свою (НЕ переопределяем)
     */
    public function run()
    {
        $activity = new Activity();

        $activity->title = 'Событие';

        if ($activity->validate()) {
            $activity->arrayErrors = '';
        }
        else {
            $activity->arrayErrors = $activity->getErrors();
            //VarDumper::dump($activity->getErrors()); exit;
        };

        //    $attr = $activity->getAttributes();
        //    echo '<pre>';
        //    VarDumper::dump($attr);
        //    echo '</pre>';
        //     exit;

        return $this->controller->render('index', ['model' => $activity, 'myLabel' => 123456]);
    }
}