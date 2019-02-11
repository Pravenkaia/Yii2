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


    /**
     * @return array|bool
     */
    public function auth()
    {

        if ($this->validate()) {
            $user = $this->passwordValidator();
            if (!$user) {
                return false;
            } else {
                Yii::$app->user->login($user, 3600);
                return $user;
            }
        }

        return false;

    }

    /**
     * @return array|bool
     */
    public function passwordValidator()
    {
        /** @var array $user */
        $user = $this->getUserByEmail();
        if (!$user) {
            $this->addError('email', 'Пользователь с ' . $this->email . ' не найден');
            return false;
        } else {
            //echo '<pre>'; var_dump($user); echo '<pre>'; exit;
            if (!Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
                $this->addError('password', 'Ошибочный пароль');
                return false;
            }
            return $user;
        }
    }


    /**
     * @return mixed
     */
    public function getUserByEmail()
    {
        ///** @var array $user */
        //$user = self::find()->andWhere(['email' => $this->email])->one();
        //if (!$user)
        //    return false;
        //else {
        //    //echo '<pre>'; var_dump($user); echo '<pre>'; exit;
        //    return $user;
        //}
        return self::find()->andWhere(['email' => $this->email])->one();
    }

}