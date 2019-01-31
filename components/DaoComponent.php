<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 29.01.2019
 * Time: 18:11
 */
/**
 * Created by PhpStorm.
 * User: Talisman
 * Date: 28.01.2019
 * Time: 19:54
 */
namespace app\components;
use app\models\Activity;
use app\models\Users;
use yii\base\Component;
use yii\db\Exception;
use yii\db\Query;
use yii\log\Logger;
class DaoComponent extends Component
{
    public function getAllUsers(){
        $sql='select * from users;';
        $db=$this->getDb();
        return $db->createCommand($sql)->queryAll();
    }
    public function getStrongData(){
        $query=new Query();
        $reader=$query->from('activity')->createCommand()->query();
        foreach ($reader as $item){
            //funct
        }
    }
    public function queryTransact(){
        $transaction=$this->getDb()->beginTransaction();
        try{
            $this->getDb()->createCommand()->update(Users::tableName(),
                ['email'=>'sd@email.ur'],['id'=>1])->execute();
//            throw new Exception('test exeption');
            $this->getDb()->createCommand()->insert(Activity::tableName(),[
                'user_id'=>2,
                'title'=>'title',
                'dateStart'=>date('Y-m-d H:i:s')
            ])->execute();
            $transaction->commit();
        }catch (\Exception $e){
//            throw new $e;
            \Yii::getLogger()->log($e->getMessage().' '.$e->getTraceAsString(),Logger::LEVEL_ERROR);
            $transaction->rollBack();
        }
    }
    public function getActivityUser($id_user){
        $sql='select * from activity where user_id=:user';
        return $this->getDb()->createCommand($sql,[':user'=>$id_user])->queryAll();
    }
    public function getAnyActivity(){
        $sql='select * from activity;';
        return $this->getDb()->createCommand($sql)->queryOne();
    }
    public function getCountActivity(){
        $query=new Query();
        return $query->select('count(id) as cnt')
            ->from(Activity::tableName())
            ->andWhere('date_created<=:data',
                [':data' => date('Y-m-d H:i:s')])
            ->createCommand()->queryScalar();
    }
    public function getActivityFilter(){
        $query=new Query();
        $query->select(['activity.id','title','email'])
            ->from('activity')
            ->innerJoin(Users::tableName(),'activity.user_id=users.id')
            ->andWhere('users.id=1');
        $query->orderBy(['date_created'=>SORT_DESC])
            ->limit(2)
            ->createCommand()->getRawSql();
    }
    /**
     * @return \yii\db\Connection
     */
    public function getDb(){
        return \Yii::$app->db;
    }
}