<?php


namespace app\components;


use app\components\interfaces\NotificationInterface;
use app\models\Activity;
use yii\mail\MailerInterface;

class NotificationService implements NotificationInterface
{
    /**
     * @var MailerInterface
     */
    private $mailer;


    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param $activities Activity[]
     * @return bool
     */
    public function sendNotification($activities): bool
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