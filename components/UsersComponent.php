<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 08.02.2019
 * Time: 17:48
 */

namespace app\components;


use yii\base\Component;


class UsersComponent extends Component
{
    public $password;


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
     * @return bool
     * @throws \yii\base\Exception
     */
    public function registration($model)
    {

        if ($model->validate()) {

            $model->password_hash = \Yii::$app->security->generatePasswordHash($model->password);
            $model->token = \Yii::$app->security->generateRandomString();

            return true;
        }

        return false;
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
            if (!\Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
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
        /** @var array $user */
        $user = self::find()->andWhere(['email' => $this->email])->one();
        if (!$user)
            return false;
        else {
            //echo '<pre>'; var_dump($user); echo '<pre>'; exit;
            return $user;
        }
    }
}