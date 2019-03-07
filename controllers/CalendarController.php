<?php


namespace app\controllers;


use app\models\Calendar;
//use app\models\Day;
use yii\base\Controller;

class CalendarController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
       //if (isset($_GET['month'])) $m = (int)$_GET['month'];
       //else $m = 0;
       //if (isset($_GET['year'])) $y = (int)$_GET['year'];
       //else $y = 0;
       //if (isset($_GET['day'])) $d = (int)$_GET['day'];
       //else $d = 1;

        //echo '<br><br><br><br><br><br><br><br><pre>'; var_dump($_GET); echo '</pre>';

        //$model = new Calendar($arr = ['m' => $m, 'd' => $d,'y' => $y]);

        $model = new Calendar();
        \Yii::$app->cache->flush();
        return $this->render('index', ['model' => $model]);
    }
    public function actionDay()
    {
        //if (isset($_GET['month'])) $m = (int)$_GET['month'];
        //else $m = 0;
        //if (isset($_GET['year'])) $y = (int)$_GET['year'];
        //else $y = 0;
        //if (isset($_GET['day'])) $d = (int)$_GET['day'];
        //else $d = 1;

        $model = new Calendar();

        //$model = new Calendar($arr = ['m' => $m, 'd' => $d,'y' => $y]);
        return $this->render('day', ['model' => $model]);
    }
}