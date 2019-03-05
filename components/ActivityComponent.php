<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 10.02.2019
 * Time: 15:46
 */

namespace app\components;


use app\models\Activity;
use phpDocumentor\Reflection\Types\Null_;
use yii\base\Component;
use yii\db\Exception;
use yii\helpers\FileHelper;
use yii\web\HttpException;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class ActivityComponent extends Component
{

    /**
     * @return Activity
     */
    public static function getModelActivity()
    {
        return new Activity();
    }

    /**
     * @param $where
     * @param $params
     * @return Activity[]|null
     */
    public function getActivities($where, $params)
    {
        return $this->getModelActivity()::find()->andWhere($where, $params)->all();
    }


    /**
     * @param $id
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteActivity($id)
    {
        $model = $this->getActivity($id);
        if ($model->delete()) {
            return true;
        };

        return false;
    }

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
     * @throws Exception
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
     * @return array
     * @throws Exception
     */
    public function getAllActivitiesDates($d)
    {
        $query = new Query();

        return $query->select('*,*')
            ->from('activity')
            ->innerJoin('users', 'activity.id_user=users.id')
            ->where(['>=', 'date_start', date('Y-m-d H:s:i', $d)])
            ->andWhere(['<', 'date_start', date('Y-m-d H:s:i', $d + (60 * 60 * 24))])
            //->orWhere(['<=', 'date_end', date('Y-m-d H:s:i', $d)])
            ->orderBy(['date_end' => SORT_DESC])
            ->createCommand()
            ->queryAll();

    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAllActivitiesParams($where, $params)
    {
        $query = new Query();

        return $query->select('*,*')
            ->from('activity')
            ->innerJoin('users', 'activity.id_user=users.id')
            ->andWhere($where, $params)
            ->orderBy(['id_user' => SORT_ASC, 'date_start' => SORT_ASC])
            ->createCommand()
            ->queryAll();

    }

    /**
     * @param $where
     * @param $params
     * @throws HttpException
     */
    public function getArrayActivitiesByUsers($where, $params)
    {
        $activities = getAllActivitiesParams($where, $params);
        if (!$activities) {
            throw new HttpException(400, 'Error query');
        } else {
            // группируем по пользователям
            // здесь будет массив по пользователям
            // нужно заполучить email юзера и массив событий по юзеру
            // чтобы не делать спам. А в одном письме перечислить все события

            // группируем по пользователям


        }

    }


    /**
     * @param int $id
     * @return Activity|\app\models\ActivityBase|array|null
     */
    public function getActivity($id = 0)
    {
        return Activity::find()->andWhere(['id_activity' => $id])->one();
    }

    /**
     * @param int $id
     * @return array|bool
     * @throws yii\db\Exception
     * @throws Exception
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
            // throw new HttpException(400, 'Error query');
            // return false;
        }

    }


}