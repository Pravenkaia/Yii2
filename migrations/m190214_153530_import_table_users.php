<?php

use yii\db\Migration;

/**
 * Class m190214_153530_import_table_users
 */
class m190214_153530_import_table_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents(__DIR__ . '/yii2basic_users.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190214_153530_import_table_users cannot be reverted.\n";

        return false;
    }
    */
}
