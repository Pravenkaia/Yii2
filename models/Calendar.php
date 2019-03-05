<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 31.01.2019
 * Time: 12:39
 */

namespace app\models;


use yii\base\Model;
use yii\base\Widget;

/**
 * Class Calendar
 * @package app\models
 */
class Calendar extends Widget
{
    /**
     * месяц предыдущий
     * @var int $month_number
     */
    public $month_before;

    /**
     * месяц последующий
     * @var int $month_number
     */
    public $month_after;


    /**
     * название месяца
     * @var string $month_name
     */
    public $month_name;

    /**
     * год
     * @var int $year
     */
    public $year;

    /**
     * номер месяца
     * @var integer $month
     */
    public $month;

    /**
     * @var array $days
     */
    public $days = [];

    /**
     * максимальное число дней в месяце
     * @var int $days_in_month
     */
    public $days_in_month;

    /**
     * @var int метка  времени
     */
    public $time;

    /**
     * @var int $year_before
     */
    public $year_before;
    /**
     * @var int $year_after
     */
    public $year_after;

    /**
     * если выбран день
     * @var integer $day
     */
    public $day;

    /**
     * @var int $is_holiday
     */
    public $is_holiday;

    /**
     * @var integer $day_before
     */
    public $day_before;

    /**
     * @var integer $day_after
     */
    public $day_after;

    /**
     * @var array $day_activities
     */
    public $day_activities = [];


    public function init()
    {
        $this->setTime();
        $this->setDates();
        $this->setDays();

        parent::init();

    }

    public function setTime()
    {
        if (isset($_GET['month'])) $m = (int)$_GET['month'];
        else $m = 0;
        if (isset($_GET['year'])) $y = (int)$_GET['year'];
        else $y = 0;
        if (isset($_GET['day'])) $d = (int)$_GET['day'];
        else $d = 1;

        if ($m > 0 && $m < 13 && $y > 0) {
            $this->time = strtotime($y . '-' . $m . '-' . $d . ' 00:00:00');
        } else {
            $this->time = time();
        }
    }

    public function setDays() {
        $this->day_before = $this->day - 1;
        if ($this->day_before < 1) $this->day_before  = $this->days_in_month;

        $this->day_after = $this->day + 1;
        if ($this->day_after > $this->days_in_month) $this->day_after = 1;


    }

    /**
     * текущий месяц
     * @return void $month
     */
    public function setDates()
    {
        $this->month_name = date('F', $this->time);
        $this->month = (int)date('n', $this->time);
        $this->year = (int)date('Y', $this->time);
        $this->day = (int)date('j', $this->time);
        $this->days_in_month = (int)date('t', $this->time);


        $this->year_before = $this->year - 1;
        $this->year_after = $this->year + 1;
        $this->month_before = $this->getMonthBefore();
        $this->month_after = $this->getMonthAfter();
        $this->days = $this->getDays();
        $this->day_activities = $this->getDayActivities();
        //echo '<pre>'; var_dump($this->day_activities); echo '</pre>'; exit;
    }

    /**
     * @return int
     */
    public function getMonthBefore(): int
    {
        $this->month_before = $this->month - 1;
        if ($this->month_before < 1) {
            $this->month_before = 12;
            $this->year_after++;
        }
        return $this->month_before;
    }

    /**
     * @return int
     */
    public function getMonthAfter(): int
    {
        $this->month_after = $this->month + 1;
        if ($this->month_after > 12) {
            $this->month_after = 1;
        }
        return $this->month_after;
    }

    /**
     * @return array
     */
    public function getDays()
    {

        for ($i = 1; $i <= $this->days_in_month; $i++) {
            $d = strtotime($this->year . '-' . $this->month . '-' . $i . ' 00:00:00');
            $this->days[$i] = [
                'day_number' => $i,
                'day_of_week' => \Yii::t('app', date('l', $d)),
                'activities' => $this->getActivities($d),
            ];
        }
        return $this->days;
    }

    /**
     * @param $d
     * @return mixed|array|boolean
     */
    public function getActivities($d)
    {
        $bigArr = \Yii::$app->acts->getAllActivitiesDates($d);


        foreach ($bigArr as $smallArr) {
            $arr[] = [
                'id' => $smallArr['id_activity'],
                'title' => $smallArr['title'],
                'author' => $smallArr['username']
            ];
        }
        //echo '<pre>'; var_dump($arr); echo '</pre>'; exit;
        if (isset($arr))
            return $arr;
        else
            return false;
    }


    /**
     * @return array|bool
     */
    public function getDayActivities() {

        $bigArr = \Yii::$app->acts->getAllActivitiesDates($this->time);


        foreach ($bigArr as $smallArr) {
            $arr[] = [
                'id' => $smallArr['id_activity'],
                'title' => $smallArr['title'],
                'date_start' => $smallArr['date_start'],
                'date_end' => $smallArr['date_end'],
                'author' => $smallArr['username']
            ];
        }
        //echo '<pre>'; var_dump($arr); echo '</pre>'; exit;
        if (isset($arr))
            return $arr;
        else
            return false;

    }


}