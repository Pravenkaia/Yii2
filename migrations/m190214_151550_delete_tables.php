<?php

use yii\db\Migration;

/**
 * Class m190214_151550_delete_tables
 */
class m190214_151550_delete_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('activity');
        $this->dropTable('users');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m190214_151550_delete_tables cannot be reverted.\n";
        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190214_151550_delete_tables cannot be reverted.\n";

        return false;
    }
    */
}
