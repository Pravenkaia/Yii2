<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:50
 */

namespace app\models;


/**
 * Class Activity
 * @package app\models
 * Сущность события,  хранимого в календаре
 */
class Activity extends ActivityBase
{
    /**
     * дата начала события в формате 'Y-m-d'
     * @var string $date_activity
     */
    public $date_activity;

    /**
     * временная пока организую классы картинок
     * @var $picture array
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
     * @var array $files
     */
    public $files = [];

    /**
     * метод определяет правила валидации
     * @return array
     */

    /**
     * @var string $document_file
     */
    public $document_file;

    public function rules()
    {
        return array_merge([
           // [['title'], 'required'], //, 'description'
           // ['title', 'string', 'min' => 3],
            //[['is_repeatable', 'is_blocking'], 'boolean'],
            ['email', 'email'],
          //  [['picture'], 'image', 'maxFiles' => 10],
          //  ['document_file', 'file', 'extensions' => ['pdf'], 'skipOnError' => false]

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


    //public function formatDates()
    //{
    //    $timestamp_start = strtotime($this->date_start);
    //    if (!$this->date_end)
    //        $timestamp_end = $timestamp_start;
    //    else
    //        $timestamp_end = strtotime($this->date_end);
    //    $this->date_start = date('Y-m-d H:s:i', $timestamp_start);
    //    $this->date_end = date('Y-m-d H:s:i', $timestamp_end);
    //    return true;
    //}

    //public function upload()
    //{
    //    if ($this->validate()) {//
    //        $path = \Yii::getAlias('@app/uploads/');
    //        if (!FileHelper::createDirectory($path)) {
    //            throw new HttpException('Не удалось создать папку по адресу ' . $path);
    //        }
//
    //        //$file_name = $path . 'doc_' . date('d-m-Y', time()) . '.' . $this->document->extension;
//
    //        if (
    //        $this->document->saveAs($path . 'doc_' . date('d-m-Y', time()) . '.' . $this->document->extension)
    //        ) {
    //            //$this->files = $file_name;
//
    //            return true;
    //        } else
    //            return false;
//
    //    }
    //}






}
