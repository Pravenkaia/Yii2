<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 31.01.2019
 * Time: 12:39
 */

namespace app\models;


use yii\base\Model;

class Day extends Model
{
    /**
     * @var int $id_day
     */
    public $id_day;

    /**
     * Если выходной день = 1, иначе = 0 // не знаю, как правильно сделать
     * @var int $is_holiday
     */
    public $is_holiday;

    /**
     * массив связанных событий
     * @var array $id_activities
     */
    public $id_activities = [];




}