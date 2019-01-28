<?php

namespace app\modules\activity\controllers;

use app\base\BaseController;
use app\modules\activity\models\Activity;
use app\modules\activity\controllers\actions\ActivityIndexAction;
use app\modules\activity\controllers\actions\PampamAction;


class IndexController extends BaseController
{
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
    /*
    public function actionIndex()
    {
        $activity = new Activity();
        $activity->title =  'Название события. view index/index';
        if ($activity->validate()) {
            $activity->arrayErrors = '';
        }
        else {
            $activity->arrayErrors = $activity->getErrors();
            //VarDumper::dump($activity->getErrors()); exit;
        };

        return $this->render('index', ['model' => $activity]);
    }
    */
}
