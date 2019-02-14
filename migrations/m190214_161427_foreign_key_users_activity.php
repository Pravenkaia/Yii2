<?php

use yii\db\Migration;

/**
 * Class m190214_161427_foreign_key_users_activity
 */
class m190214_161427_foreign_key_users_activity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('activity_userFK',
            'activity','id_user', 'users', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m190214_161427_foreign_key_users_activity cannot be reverted.\n";
//
        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190214_161427_foreign_key_users_activity cannot be reverted.\n";

        return false;
    }
    */
}
