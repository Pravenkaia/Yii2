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
use yii\web\UploadedFile;
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

        //$activity->title = 'Событие';


        if ($activity->validate()) {
            $activity->arrayErrors = '';
        }
        else {
            $activity->arrayErrors = $activity->getErrors();
            //VarDumper::dump($activity->getErrors()); exit;
        };
        //echo $this->settings; exit;
        //    $attr = $activity->getAttributes();
        //    echo '<pre>';
        //    VarDumper::dump($attr);
        //    echo '</pre>';
        //     exit;

        \Yii::$app->view->params['settings'] = $this->settings ;
        return $this->controller->render('index', ['model' => $activity, 'settings' => $this->settings]);
    }
}