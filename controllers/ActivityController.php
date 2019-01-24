<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:14
 */

namespace app\controllers;


use app\base\BaseController;
use app\models\Activity;
use yii\helpers\VarDumper;

class ActivityController extends BaseController
{

    public function actionIndex(){

        $activity = new Activity();

        $activity->title = 'Событие';

      // if (!$activity->validate()) echo '442536'; // не работает

            $attr = $activity->getAttributes();
            echo '<pre>';
            VarDumper::dump($attr);
            echo '</pre>';
            exit;
        //}

        return $this->render('index',[]);
    }
}