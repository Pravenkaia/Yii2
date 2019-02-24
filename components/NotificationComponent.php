<?php


namespace app\components;


use yii\base\Component;
use yii\mail\MailerInterface;
use app\models\Activity;

class NotificationComponent extends Component
{
    /**
     * @var MailerInterface
     */
    public $mailer;

    /**
     * @param Activity[] $activities
     * @return bool
     */
    public function sendNotifications($activities): bool
    {
        foreach ($activities as $activity) {
            //var_dump($activity);
            $send = $this->mailer->compose('today', ['model' => $activity])

                ->setFrom('pravlen@adventureraces.ru')
                ->setTo($activity->email)
                //->setFrom('geekbrains@onedeveloper.ru')
                ->setSubject('Грядущие активности Правенькая. GeekbBrains')
                ->setCharset('UTF-8')
                ->setCc('pravlen@rukzak.ru')
                ->send();
            if (!$send)
                return false;
        }
        return true;
    }

}