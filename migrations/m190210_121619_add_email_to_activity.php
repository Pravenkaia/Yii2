<?php

use yii\db\Migration;

/**
 * Class m190210_121619_add_email_to_activity
 */
class m190210_121619_add_email_to_activity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'email', $this->string(150));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('activity', 'email');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190210_121619_add_email_to_activity cannot be reverted.\n";

        return false;
    }
    */
}
