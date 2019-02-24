<?php


namespace app\commands;


use app\components\NotificationComponent;
use Yii;
use yii\base\InvalidConfigException;
use yii\console\Controller;

class NotificationController extends Controller
{
    /**
     * @throws InvalidConfigException
     */
    public function actionSendTodayActivity() {
        echo 'OkОК' . PHP_EOL;
        $activities = Yii::$app->acts->getActivities('date_start>=:date',[':date' => date('Y-m-d')]);

        //echo count($activities) . PHP_EOL;
        /**
         * @var NotificationComponent $notification
         */
        $notification = Yii::createObject(['class' => NotificationComponent::class,
            'mailer' => Yii::$app->mailer
        ]);

        if($notification->sendNotifications($activities)){
            echo 'Письма успешно отправлены';
        }
        else{
            echo 'Ошибка при отправке писем';
        }
    }

    public function actionIndex() {
        echo 'OkОКIndex' . PHP_EOL;
    }

}