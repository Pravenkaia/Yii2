<?php

namespace app\models;

use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $token
 * @property string $date_created
 *
 * @property Activity[] $activities
 */
class Users extends UsersBase implements IdentityInterface
{
    /**
     * @var string $password
     */
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge([
            [['password'], 'required'],
            ['password', 'string'], //, 'passwordValidator'
        ], parent::rules());
    }




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
     * @param int|string $id
     * @return void|IdentityInterface
     * * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public
    static function findIdentity($id)
    {
        //$query = self::find();
        //$query->andWhere(['id=' => $id])->one();
        return self::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public
    static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public
    function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public
    function getAuthKey()
    {
        return $this->token;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public
    function validateAuthKey($authKey)
    {
        return $this->authKey == $authKey;
    }
}
