<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 29.01.2019
 * Time: 18:11
 */


namespace app\components;


use Throwable;
use Yii;
use yii\base\Component;
use yii\caching\DbDependency;
use yii\caching\TagDependency;
use yii\db\Exception;
use yii\db\Query;
use yii\log\Logger;


class DaoComponent extends Component
{
    /**
     * @return array
     * @throws Exception
     */
    public function getAuthItem() {
        $query = new Query();
        return $query->select('*,*')
            ->from('auth_item')
            ->createCommand()
            ->cache(20)
            ->queryAll();
    }

    /**
     * @throws Exception
     */
    public function queryTransact() {
        $transaction  = $this->getDb()->beginTransaction();

        try{
            $this->getDb()->createCommand()->update('users',
                [
                    'username' => 'Бегемот',
                    'password_hash' => Yii::$app->security->generatePasswordHash('123456')],
                ['id' => '25'])
                ->execute();

            $this->getDb()->createCommand()->update('users',
                ['password_hash' => Yii::$app->security->generatePasswordHash('123456')],
                ['id' => '1'])
                ->execute();

            $this->getDb()->createCommand()->insert('activity',
                ['id_user' => '1',
                    'title' => 'Заголовк у юзера 1 (а не 2)', //для несуществующего юзера не прошла
                    'date_start' => date('Y-m-d H:i:s')
                    ])
            ->execute();
        } catch (\Exception $e) {
            Yii::getLogger()->log($e->getMessage(),Logger::LEVEL_ERROR);
            $transaction->rollBack();
        }
    }

    /**
     * @return array getAllUsers()
     * @throws Exception
     * @throws Throwable
     */
    public function getAllUsers()
    {
        $sql = 'select * from users;';
        //return $this->getDb()->cache(function() use($sql){
        //    return $this->getDb()->createCommand($sql)->queryAll();
        //},6);
        return $this->getDb()->createCommand($sql)->cache(15)->queryAll();
    }

    /**
     * @return array getAllActivities()
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
            ->cache(20)
            ->queryAll();
    }

    public function saveActivity() {
        return true;
    }

    public function getCountActivities($id_user = 0)
    {

        $query = new Query();
        //$dependency = new DbDependency(['sql' => 'select max(id_activity) from activity where id_user=' . (int)$id_user]);
        $dependency = new TagDependency(['tags' => 'my_tag']);

        $query->select('count(id_activity) as cnt')
            ->from('activity');
        if ($id_user > 0) {
            $query->where('id_user=:id_user')
                ->addParams([':id_user' => $id_user]);
        }

        return $query->createCommand()->cache(0, $dependency)->queryScalar();


    }

    /**
     * @param $id_user
     * @return array
     * @throws Exception
     */
    public function getActivityUser($id_user = 0)
    {
        $sql = 'SELECT * from activity WHERE id_user=:id_user';
        $dependency = new DbDependency(['sql' => 'select max(id_activity) from activity where id_user=' . (int)$id_user]);
        return $this->getDb()->createCommand($sql, [':id_user' => $id_user])
            ->cache(6,$dependency)->queryAll();
    }





    /**
     * @return \yii\db\Connection
     */
    public
    function getDb()
    {
        return Yii::$app->db;
    }
}