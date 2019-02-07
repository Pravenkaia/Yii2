<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 03.02.2019
 * Time: 22:09
 */

namespace app\components;


use app\models\Users;
use yii\base\Component;
use \yii\web\IdentityInterface;


class AuthComponent extends Component //implements IdentityInterface
{

    /**
     * @param $pass
     * @return string
     * @throws \yii\base\Exception
     */
    public function getPassHash($pass)
    {
        return \Yii::$app->security->generatePasswordHash($pass);
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function getToken()
    {
        return \Yii::$app->security->generateRandomString();
    }




    /**
     * @return \yii\db\Connection
     */
    public function getDb()
    {
        return \Yii::$app->db;
    }


}