<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 10.02.2019
 * Time: 15:46
 */

namespace app\components;


use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\HttpException;
use yii\db\Query;

class ActivityComponent extends Component
{

    /**
     * устанавливает формат даты начала и конца событий по формату БД
     * @param $obj
     * @return bool
     */
    public function formatDates($obj)
    {
        $timestamp_start = strtotime($obj->date_start);
        if (!$obj->date_end)
            $timestamp_end = $timestamp_start;
        else
            $timestamp_end = strtotime($obj->date_end);
        $obj->date_start = date('Y-m-d H:s:i', $timestamp_start);
        $obj->date_end = date('Y-m-d H:s:i', $timestamp_end);
        $obj->date_activity = date('Y-m-d', $timestamp_start);
        return true;
    }

    /**
     * загружает файл
     * писваивает имя файлу для загрузки в БД
     * @param $obj
     * @param $file
     * @param string $fold
     * @return bool
     * @throws HttpException
     * @throws \yii\base\Exception
     */
    public function upload_docs($obj, $fold = '@app/uploads/')
    {

        if ($obj->date_activity == '') {
            $obj->date_activity = date('d-m-Y', time());
        }

        if (!$obj->document_file)
            return false;
        $path = \Yii::getAlias($fold);
        if (!FileHelper::createDirectory($path)) {
            throw new HttpException('Не удалось создать папку по адресу ' . $path);
        }

        $file = 'doc_' . $obj->date_activity . '.' . $obj->document_file->extension;
        if ($file->saveAs($path . $file)) {
            $obj->document = $file;
            return $obj->document;
        } else {
            throw new HttpException('Не удалось сохранить файл ' . $path);
        }

    }

    /**
     * @return array
     * @throws \yii\db\Exception
     */
    public function getAllActivities()
    {
        $query = new Query();

        return $query->select('*,*')
            ->from('activity')
            ->innerJoin('users', 'activity.id_user=users.id')
            ->orderBy(['date_end' => SORT_DESC])
            ->createCommand()
            ->queryAll();

    }

    /**
     * @param int $id
     * @return array|bool
     * @throws \yii\db\Exception
     */
    public function getUsersActivities($id = 0)
    {
        $query = new Query();

        if ($id > 0) {
            return $query->select('*,*')
                ->from('activity')
                ->innerJoin('users', 'activity.id_user=users.id')
                ->andWhere('id=:id', [':id' => $id])
                ->orderBy(['date_end' => SORT_DESC])
                ->createCommand()
                ->queryAll();
        } else {
            return false;
        }

    }

}