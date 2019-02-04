<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:50
 */

namespace app\models;

//use yii\base\Model;
use app\models\ActivityBase;
use yii\helpers\FileHelper;
use yii\web\HttpException;
use yii\web\UploadedFile;
use yii\rbac\Rule;

/**
 * Class Activity
 * @package app\models
 * Сущность события,  хранимого в календаре
 */
class Activity extends ActivityBase
{
    /**
     * ID события
     * @var $id_activity int
     */
    public $id_activity;

    /**
     * ID автора, создавшего события
     * @var $id_author int
     */
    public $id_author;

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
     * @var $date_start int
     *  дата начала события
     *  Значение Unix timestamp
     */
    public $date_start;

    /**
     * @var $date_end int
     *  дата начала события
     *  Значение Unix timestamp
     */
    public $date_end;

    /**
     * @var $is_repeatable boolean
     * повторяющееся событие
     */
    public $is_repeatable;

    /**
     * @var $is_blocking boolean
     * повторяющееся событие
     */
    public $is_blocking;

    /**
     * @var int $date_created
     */
    public $date_created;

    /**
     * @var int $date_changed
     */
    public  $date_changed;

    /**
     * просто так (подписка на события все-таки по id юзера)
     * @var $email string
     */
    public $email;

    /**
     * временная пока организую классы картинок
     * @var $picture string
     */
    public $picture;

    /**
     *  временная пока не организую классы документов
     * @var $document string
     */
    public $document;

    /**
     * вспомогательная переменная
     * @var $array_errors array
     */
    public $array_errors = [];

    /**
     * спомогательная временная, пока не разберусь, как устройить привязку документов и фото
     * @var array  $files
     */
    public $files = [];

    /**
     * метод определяет правила валидации
     * @return array
     */
    public function rules()
    {
        return array_merge([
            [['title', 'description'], 'required'],
            ['title', 'string', 'min' => 3],
            [['is_repeatable', 'is_blocking'], 'boolean'],
            ['email', 'email'],
            [['picture'], 'image', 'maxFiles' => 10],
            ['document', 'file', 'extensions' => ['pdf']]
            //['idAuthor', 'required'],
        ], parent::rules());
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
            'id_author' => 'ID автора',
            'description' => 'Описание события',
            'is_repeatable' => 'Повторяется?',
            'is_blocking' => 'Несовместимо с другими событиями?',
            'email' => 'E-mail (подписка на рассылку)',
            'picture' => 'Добавьте изображения',
            'document' => 'Добавьте файл (только PDF!)',
        ];
    }



    public function upload()
    {
        if ($this->validate()) {
            $path = \Yii::getAlias('@app/uploads/');
            if (!FileHelper::createDirectory($path)) {
                throw new HttpException('Не удалось создать папку по адресу ' . $path);
            }
            $this->files[] = $this->document;
            //документ

            $this->document->saveAs($path . 'doc_' . date('d-m-Y', time()) . '.' . $this->document->extension); // $this->document->baseName
            //    //картинки
            //    $i = 1;
            //    foreach ($this->picture as $file) {
            //        $file->saveAs('uploads/' . date('d-m-Y',time()) . $i++ . '.' . $file->extension); //$file->baseName
            //    }
            return true; //true;
        }
        return false;
    }
}