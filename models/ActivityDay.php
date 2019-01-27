<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 25.01.2019
 * Time: 14:28
 */

namespace app\models;


use yii\base\Model;

class ActivityDay extends Model
{
    /**
     * Если выходной день = 1, иначе (рабочий) = 0
     * @var $isHoliday int
     */
    public $isHoliday;

    /**
     * массив связанных событий
     * @var array $idActivities
     */
    public $idActivities = [];


}