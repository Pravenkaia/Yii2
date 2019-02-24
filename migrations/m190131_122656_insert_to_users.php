<?php

use yii\db\Migration;

/**
 * Class m190131_122656_insert_to_users
 */
class m190131_122656_insert_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users', [
            'id' => '25',
            'email' => 'vas@rt.eee',
            'username' => 'Вася',
            'password_hash' => 'rrrrrrrr',
            'token' => 'nnnnnnnnnnn'
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190131_122656_insert_to_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190131_122656_insert_to_users cannot be reverted.\n";

        return false;
    }
    */
}
