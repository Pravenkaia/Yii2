<?php

namespace app\modules\activity\controllers;

use app\base\BaseController;
use app\modules\activity\models\Activity;

/**
 * Default controller for the `activity` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
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
        //echo $this->settings; exit;
        //    $attr = $activity->getAttributes();
        //    echo '<pre>';
        //    VarDumper::dump($attr);
        //    echo '</pre>';
        //     exit;

        // \Yii::$app->view->params['settings'] = $this->settings ;
        return $this->render('index', ['model' => $activity]); //, 'settings' => $this->settings]

        //return $this->render('index');
    }
}
