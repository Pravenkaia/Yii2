<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:50
 */

namespace app\modules\activity\models;


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
     * ID события
     * @var $idActivity int
     */
    public $idActivity;

    /**
     * @var $title string
     * название события
     */
    public $title;

    /**
     * @var $description string
     * Описание события
     */
    public $description;

    /**
     * @var $dateStart int
     *  дата начала события
     *  Значение Unix timestamp
     */
    public $dateStart;

    /**
     * @var $dateEnd int
     *  дата начала события
     *  Значение Unix timestamp
     */
    public $dateEnd;

    /**
     * ID автора, создавшего события
     * @var $idAuthor int
     */
    public $idAuthor;

    /**
     * @var $isRepeatable boolean
     * повторяющееся событие
     */
    public $isRepeatable;

    /**
     * @var $isBlocking boolean
     * повторяющееся событие
     */
    public $isBlocking;

    /**
     * @method rules()
     * @return array
     */

    /**
     * @var $arrayErrors array
     */
    public $arrayErrors = [];

    /**
     * метод определяет правила валидации
     * @return array
     */

    /**
     * @var $email string
     */
    public $email;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'], //, 'dateStart'
            ['title','string','min' => 3],
            [['isRepeatable', 'isBlocking'], 'boolean'],
            ['email','email'],
            //['idAuthor', 'required'],
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
            'email' => 'E-mail (подписка на рассылку)'
        ];
    }




}