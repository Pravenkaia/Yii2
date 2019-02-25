<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 02.02.2019
 * Time: 12:16
 */

namespace app\controllers;


use app\base\BaseController;
use app\components\DaoComponent;
use Yii;
use yii\db\Exception;

class DaoController extends BaseController
{
    /**
     * @param int $id_user
     * @return string
     * @throws Exception
     */
    public function actionIndex($id_user = 1)
    {
        /**
         * @var DaoComponent $dao
         */
        $dao = Yii::$app->dao;

        //$dao->queryTransact();

       // echo '<pre>';var_dump($dao->getAuthItem()); echo '</pre>'; exit;

        return $this->render('index', [
            'users' => $dao->getAllUsers(),
            'activities' => $dao->getAllActivities(),
            'cnt' => $dao->getCountActivities($id_user),
            'auth' => $dao->getAuthItem()
        ]);
    }


    public function actionCache()
    {
        $value = 'value_12';
        $value2 = 'value_100500';
        $key_cache = 'id_1';
        $key_cache2 = 'id_2';

        //// Yii::$app->cache->set($key_cache,$value);
        // Yii::$app->cache->delete($key_cache);
        //
        // $value_cache = Yii::$app->cache->get($key_cache);

        //$user_id = 42;
        //$data = $cache->getOrSet($key, function () use ($user_id) {
        //    return $this->calculateSomething($user_id);
        // }

        $value_cache = Yii::$app->cache->getOrSet($key_cache, function() use ($value){
            return $value;
        });

        $value_cache2 = Yii::$app->cache->getOrSet($key_cache2, function() use ($value2){
            return $value2;
        });

        Yii::$app->cache->flush();// ,бессмысленно  с getOrSet

        echo $value_cache;
        echo '<br>';
        //echo $value_cache2;

    }


}