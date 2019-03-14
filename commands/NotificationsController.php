<?php
/**
 * (использует реализует) пример dependency injection
 */

namespace app\commands;


use app\components\interfaces\NotificationInterface;
use app\components\NotificationComponent;
use Yii;
use yii\base\InvalidConfigException;
use yii\console\Controller;
use yii\mail\MailerInterface;

class NotificationsController extends Controller
{
    /**
     * @throws InvalidConfigException
     */
    public function actionSendTodayActivity() {
        echo 'OkОК' . PHP_EOL;
        $activities = Yii::$app->acts->getActivities('date_start>=:date',[':date' => date('Y-m-d',strtotime('2019-04-02'))]);

        echo count($activities) . PHP_EOL;


         // устанавливаем зависимости (в лекции это сделано в классе StartBootstrap. Что у меня не работает
        //это сработало. А потом сделаем в конфиге в console
        //\Yii::$container->setDefinitions([MailerInterface::class =>
        //    function(){
        //        return \Yii::$app->mailer;
        //    }]);

        /**
         * @var NotificationInterface $notification
         * получаем из контейнера зависимостей в конфиге (console.php)
         */
        //прямое обращение к классу
        //$notification = \Yii::$container->get(NotificationInterface::class);
        //обращние через alias
        $notification = \Yii::$container->get('notification');

        //print_r($notification);
        //exit;

        if($notification->sendNotification($activities)){
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