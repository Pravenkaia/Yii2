<?php

use yii\db\Migration;

/**
 * Class m190131_123549_insert_to_activity
 */
class m190131_123549_insert_to_activity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert('activity', [
            'id_activity' => '1',
            'id_user' => '25',
            'title' => 'Тестовое событие',
            'date_start' => '2019-05-01 00:00:00',
            'date_end' => '2019-05-03 00:00:00'

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('activity',[
            'title' => 'Тестовое событие'
        ]);
        //echo "m190131_123549_insert_to_activity cannot be reverted.\n";
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
        echo "m190131_123549_insert_to_activity cannot be reverted.\n";

        return false;
    }
    */
}
