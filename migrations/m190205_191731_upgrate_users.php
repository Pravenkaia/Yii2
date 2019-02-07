<?php

use yii\db\Migration;

/**
 * Class m190205_191731_upgrate_users
 */
class m190205_191731_upgrate_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        \Yii::$app->db->createCommand()->update('users',
            ['username' => 'admin', 'email' => 'admin@email.ru'],
            ['id' => '25'])
            ->execute();

        \Yii::$app->db->createCommand()->update('users',
            ['username' => 'user Петя', 'email' => 'user@email.ru'],
            ['id' => '1'])
            ->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190205_191731_upgrate_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190205_191731_upgrate_users cannot be reverted.\n";

        return false;
    }
    */
}
