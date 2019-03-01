<?php


namespace app\models;


use Yii;

class UsersUpdate extends UsersAuth
{
    /**
     * @var $new_password
     */
    public $new_password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge([
            [['new_password'], 'string'],
         ], parent::rules());
    }

    /**
     * @throws \yii\base\Exception
     */
    public function newPasswordHash() {
       $this->password_hash = Yii::$app->security->generatePasswordHash($this->new_password);
    }



}