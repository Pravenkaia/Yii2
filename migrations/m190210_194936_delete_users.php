<?php

use yii\db\Migration;

/**
 * Class m190210_194936_delete_users
 */
class m190210_194936_delete_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //$this->delete('users', 'id IN [26,27,28]');
        $this->delete('users', 'id=26');
        $this->delete('users', 'id=27');
        $this->delete('users', 'id=28');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190210_194936_delete_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190210_194936_delete_users cannot be reverted.\n";

        return false;
    }
    */
}
