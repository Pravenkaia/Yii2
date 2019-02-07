<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
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
 *
 * @property Users $user
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['id_user', 'is_repeatable', 'is_blocking'], 'integer'],
            [['title', 'date_start'], 'required'],
            [['date_start', 'date_end', 'date_created', 'date_changed'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 150],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }
}
