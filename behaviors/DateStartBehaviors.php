<?php


namespace app\behaviors;


use yii\base\Behavior;

/**
 * Class DateStartBehaviors
 * @package app\behaviors
 */
class DateStartBehaviors extends Behavior
{
    public $date_to_format;

    /**
     * @param bool $to_format
     * @return false|mixed|string
     */
    public function getDateFormatted($to_format = true)
    {
        $owner = $this->owner;

        $date = $owner->{$this->date_to_format};

        if(!$to_format) {
            return $date;
        }
        else{
            return date('d.m.Y H:s:i', strtotime($date));
        }

    }

}