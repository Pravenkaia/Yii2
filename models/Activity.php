<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:50
 */

namespace app\models;


use yii\base\Model;
use yii\rbac\Rule;

/**
 * Class Activity
 * @package app\models
 * Сущность события,  хранимого в календаре
 */
class Activity extends Model
{
    /**
     * @var string
     * название события
    */
    public $title;

    /**
     * @var string
     * Описание события
     */
    public $description;

    /**
     * @var int
     *  дата начала события
     *  Значение Unix timestamp
     */
    public $dateStart;

    /**
     * @var int
     *  дата начала события
     *  Значение Unix timestamp
     */
    public $dateEnd;

    /**
     * ID автора, создавшего события
     * @var int
     */
    public $idAuthor;

    /**
     * @var boolean
     * повторяющееся событие
     */
    public $isRepeatable;

    /**
     * @var boolean  $isBlocking
     * повторяющееся событие
     */
    public $isBlocking;

    /**
     * @method rules()
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'description', 'dataStart'], 'required'],
            [['isRepeatable', 'isBlocking'],'boolean'],
        ];
    }

    /**
     * @method
     * Возвращает массив меток полей формы
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Название события',
            'dateStart' => 'Дата начала',
            'dateEnd' => 'Дата завершения',
            'idAuthor' => 'ID автора',
            'description' => 'Описание события',
            'isRepeatable' => 'Повторяется?',
            'isBlocking' => 'Несовместимо с другими событиями?',
        ];
    }


}