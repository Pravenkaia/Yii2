<?php


namespace app\controllers;


use app\models\Calendar;
use app\models\Day;
use yii\base\Controller;

class CalendarController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new Calendar();
        return $this->render('index', ['model' => $model]);
    }
    public function actionDay()
    {
        $model = new Calendar();
        return $this->render('day', ['model' => $model]);
    }
}