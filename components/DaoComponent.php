<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 29.01.2019
 * Time: 18:11
 */


namespace app\components;


use yii\base\Component;
use yii\db\Exception;
use yii\db\Query;
use yii\log\Logger;


class DaoComponent extends Component
{
    public function getAuthItem() {
        $query = new Query();
        return $query->select('*,*')
            ->from('auth_item')
            ->createCommand()
            ->queryAll();
    }

    public function queryTransact() {
        $transaction  = $this->getDb()->beginTransaction();

        try{
            $this->getDb()->createCommand()->update('users',
                ['username' => 'Бегемот'],['id' => '25'])
                ->execute();

            $this->getDb()->createCommand()->insert('activity',
                ['id_user' => '1',
                    'title' => 'Заголовк у юзера 1 (а не 2)', //для несуществующего юзера не прошла
                    'date_start' => date('Y-m-d H:i:s')
                    ])
            ->execute();
        } catch (\Exception $e) {
            \Yii::getLogger()->log($e->getMessage(),Logger::LEVEL_ERROR);
            $transaction->rollBack();
        }
    }
    /**
     * @return array getAllUsers()
     * @throws Exception
     */
    public function getAllUsers()
    {
        $sql = 'select * from users;';
        $db = $this->getDb();
        return $db->createCommand($sql)->queryAll();
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
            ->queryAll();
    }

    public function getCountActivities($id_user = 0)
    {

        $query = new Query();

        $query->select('count(id_activity) as cnt')
            ->from('activity');
        if ($id_user > 0) {
            $query->where('id_user=:id_user')
                ->addParams([':id_user' => $id_user]);
        }

        return $query->createCommand()->queryScalar();


    }

    /**
     * @param $id_user
     * @return array
     * @throws Exception
     */
    public
    function getActivityUser($id_user = 0)
    {
        $sql = 'SELECT * from activity WHERE id_user=:id_user';
        return $this->getDb()->createCommand($sql, [':id_user' => $id_user])->queryAll();
    }



    /**
     * @return \yii\db\Connection
     */
    public
    function getDb()
    {
        return \Yii::$app->db;
    }
}