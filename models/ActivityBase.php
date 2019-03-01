<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "activity".
 * @property int $id_activity
 * @property int $id_user
 * @property string $title
 * @property string $date_start
 * @property string $date_end
 * @property int $is_repeatable
 * @property int $is_blocking
 * @property string $date_created
 * @property string $date_changed
 * @property string $description
 * @property string $email
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'is_repeatable', 'is_blocking','id_activity'], 'integer'], //
            [['title', 'date_start'], 'required'],
            [['date_start', 'date_end', 'date_created', 'date_changed'], 'safe'],
            [['description'], 'string'],
            [['title', 'email'], 'string', 'max' => 150],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_activity' => Yii::t('app', 'Id Activity'),
            'id_user' => Yii::t('app', 'Id User'),
            'title' => Yii::t('app', 'Title'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_end' => Yii::t('app', 'Date End'),
            'is_repeatable' => Yii::t('app', 'Is Repeatable'),
            'is_blocking' => Yii::t('app', 'Is Blocking'),
            'date_created' => Yii::t('app', 'Date Created'),
            'date_changed' => Yii::t('app', 'Date Changed'),
            'description' => Yii::t('app', 'Description'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::class, ['id' => 'id_user']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuth()
    {
        return $this->hasOne(AuthAssignment::class, ['user_id' => 'id_user']);
    }

    /**
     * {@inheritdoc}
     * @return ActivityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActivityQuery(get_called_class());
    }
}
