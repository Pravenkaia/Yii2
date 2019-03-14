<?php


namespace app\components\interfaces;


use app\models\Activity;

interface NotificationInterface
{
    /**
     * @param $activities Activity[]
     * @return bool
     */
    public function sendNotification($activities):bool;
}