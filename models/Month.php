<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 31.01.2019
 * Time: 12:39
 */

namespace app\models;


use yii\base\Model;

class Month extends Model
{
    /**
     * день месяца
     * @var int $day_number
     */
    public $day_number;

    /**
     * // м.б. не нужен?
     * @var int $id_month
     */
    public $id_month;

    /**
     * номер месяца м.б. не нужен
     * @var int $month_number
     */
    public $month_number;

    /**
     * название месяца
     * @var string $month_name
     */
    public $month_name;

    /**
     * @var int $year
     */
    public $year;
    /**
     * год
     * название месяца
     * @var string $month
     */
    public $month;

    /**
     * максимальное число дней в месяце
     * @var int $max
     */
    public $max;



    public function set_month()
    {
    }

    public function get_month()
    {

    }
}