<?php

use yii\db\Migration;

/**
 * Class m190214_154354_import_table_activity
 */
class m190214_154354_import_table_activity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents(__DIR__ . '/yii2basic_activity.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190214_154354_import_table_activity cannot be reverted.\n";

        return false;
    }
    */
}
