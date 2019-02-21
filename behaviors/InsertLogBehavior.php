<?php


namespace app\behaviors;


use app\models\Activity;
use Yii;
use yii\base\Behavior;
use yii\log\Logger;

class InsertLogBehavior extends Behavior
{

    public function events()
    {
        return [
            Activity::MY_LOG_EVENT => 'writeLog',
        ];
    }

    public function writeLog() {
        Yii::getLogger()->log('this is log from InsertLogBehavior', Logger::LEVEL_INFO);
    }
}