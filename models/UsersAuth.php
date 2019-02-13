<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 12.02.2019
 * Time: 18:00
 */

namespace app\models;
use yii\helpers\VarDumper;

/**
 * Class UsersAuth
 * @package app\models
 */
class UsersAuth extends Users
{
     /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function registration()
    {

        if ($this->validate()) {

            //$user = $this->isUserByEmail();
            if($this->isUserByEmail()) { // есть ли такой пользователь?
                $this->addError('email', 'Такой email  уже зарегистрирован');
                return false;
            }
            $this->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
            $this->token = \Yii::$app->security->generateRandomString();

            if (!$this->save()) {
                //throw new HttpException(400, 'saving Error');
            } else {
                $userRole = \Yii::$app->authManager->getRole('user');
               // \Yii::$app->authManager->assign($userRole, Yii::$app->user->getId());
                \Yii::$app->authManager->assign($userRole, $this->id);
                return $this->id;
            }
        }
        return false;
    }


    /**
     * @return array|bool
     */
    public function auth()
    {
            $user = $this->passwordValidator();
            if (!$user) {
                return false;
            } else {
                \Yii::$app->user->login($user, 3600);
                return $user;
            }
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
            if (!\Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
                $this->addError('password', 'Ошибочный пароль');
                return false;
            }
            return $user;
        }
    }


    /**
     * @return bool|array |\yii\db\ActiveQuery
     */
    public function getUserByEmail()
    {
        /** @var array $user */
        $user = self::find()->andWhere(['email' => $this->email])->one();
        if (!$user)
            return false;
        else {
             return $user;
        }
    }

    public function isUserByEmail()
    {
        /** @var array $user */
        return self::find()->andWhere(['email' => $this->email])->exists();
    }

}