<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:50
 */

namespace app\models;


use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\HttpException;
use yii\web\UploadedFile;
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
     * @var $picture string
     */
    public $picture;

    /**
     * @var $document string
     */
    public $document;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            ['title','string','min' => 3],
            [['isRepeatable', 'isBlocking'], 'boolean'],
            ['email','email'],
            [['picture'], 'image', 'maxFiles' => 10],
            ['document', 'file', 'extensions' => ['pdf']]
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
            'email' => 'E-mail (подписка на рассылку)',
            'picture' => 'Добавьте изображения',
            'document' => 'Добавьте файл (только PDF!)',
        ];
    }

    public $files=[];
    public function upload()
    {

        if ($this->validate()) {

            $path=\Yii::getAlias('@app/uploads/');
            if(!FileHelper::createDirectory($path)){
                throw new HttpException('Не удалось создать папку по адресу '.$path);
            }
            $this->files[]=$this->document->name;
            //документ
            $this->document->saveAs($path . 'doc_' . date('d-m-Y',time())  . '.' . $this->document->extension); // $this->document->baseName
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