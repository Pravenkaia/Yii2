<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 25.01.2019
 * Time: 13:29
 */

namespace app\modules\activity\controllers\actions;

use Yii;
use yii\helpers\VarDumper;
use app\modules\activity\models\Activity;
use yii\base\Action;

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


            //\Yii::$app->request->isPost
           // && $activity->load(Yii::$app->request->post())
            // &&
            $activity->arrayErrors = '';
            //обработка введенных данных
            if (\Yii::$app->request->isPost) {
                //$attr = $activity->getAttributes();
                //$attr = $activity->load(Yii::$app->request->post());
                $activity->load(Yii::$app->request->post());

            }

            //return $this->controller->render('submit', ['model' => $activity, 'settings' => $this->settings]);
            return $this->controller->render('index', ['model' => $activity, 'settings' => $this->settings]);
        }
        else {

            $activity->arrayErrors = $activity->getErrors();
            //echo '<pre>';
            //echo 'Не пройдена валидация';

           // VarDumper::dump($activity->getErrors());
            //echo '</pre>';
            //exit;
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


   //public function actionSubmit() {
   //    //return $this->controller->render('submit', ['model' => $activity, 'settings' => $this->settings]);
   //    return $this->controller->render('index', ['model' => $activity, 'settings' => $this->settings]);
   //}
}