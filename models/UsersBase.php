<?php

namespace app\models;

use Yii;

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
 */
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['date_created', 'password_hash'], 'safe'],
            [['username'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 120],
            [['password_hash'], 'string', 'max' => 64],
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
     * @return yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::class, ['id_user' => 'id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getAuth()
    {
        return $this->hasOne(AuthAssignment::class, ['id_user' => 'id']);
    }

    public function getRole()
    {
        return $this->hasOne(AuthAssignment::class, ['user_id' => 'id']);
    }
}
