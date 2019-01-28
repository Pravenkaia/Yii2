<?php

namespace app\modules\activity\controllers;

use app\base\BaseController;
use app\modules\activity\models\Activity;
use app\modules\activity\controllers\actions\ActivityIndexAction;
use app\modules\activity\controllers\actions\PampamAction;

/**
 * Default controller for the `activity` module
 */
class DefaultController extends BaseController
{

    /**
     * @return array
     * переопределяем
     */
    public function actions()
    {
        return [
            'index' => ['class' => ActivityIndexAction::class, //ActivityIndexAction::class,
                'settings' => 'param'
            ],
            'default' => ['class' => ActivityIndexAction::class,
            ],
            'pampam' => ['class' => PampamAction::class,
            ],

        ];
    }

    /**
     * Renders the index view for the module
     * @return object
     */
   /* public function actionIndex()
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
   */
}
