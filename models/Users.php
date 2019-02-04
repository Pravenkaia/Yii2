<?php

namespace app\models;

use app\components\AuthComponent;
use phpDocumentor\Reflection\Types\Self_;
use Yii;
use yii\filters\auth\AuthInterface;
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
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @var string $password
     */
    public $password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function registration()
    {
        if ($this->validate()) {
            /**
             * @var AuthComponent $auth
             */
            $auth = Yii::$app->auth;
            //$this->password_hash = $auth->getPassHash($this->password);
            //$this->token = $auth->getToken();
            // всё закомментироанное работает. Не вижу смысла в компоненте. Он нужен для возможности изменений??

            $this->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
            $this->token = \Yii::$app->security->generateRandomString();

            if ($this->save())
                return true;
            else
                return false;
        }
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
     * @return bool|array |\yii\db\ActiveQuery
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'], //, 'password_hash' 'username',
            [['date_created'], 'safe'],
            [['username'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 120],
            ['password', 'passwordValidator'],
            // [['password_hash'], 'string', 'max' => 64],
            [['token'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'token' => Yii::t('app', 'Token'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['id_user' => 'id']);
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
    public static function findIdentity($id)
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
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
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
    public function getAuthKey()
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
    public function validateAuthKey($authKey)
    {

    }
}
