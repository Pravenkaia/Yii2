<?php

use yii\db\Migration;

/**
 * Class m190131_113745_data_insirt_to_users_activity
 */
class m190131_113745_data_insirt_to_users_activity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users', [
            'email' => 'some@rt.eee',
            'username' => 'Петя',
            'password_hash' => 'qqqq',
            'token' => 'fffff'
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
       //echo "m190131_113745_data_insirt_to_users_activity cannot be reverted.\n";

       //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190131_113745_data_insirt_to_users_activity cannot be reverted.\n";

        return false;
    }
    */
}
