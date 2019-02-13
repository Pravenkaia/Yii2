<?php

use yii\db\Migration;

/**
 * Class m190206_124737_add_coloumn_desription
 */
class m190206_124737_add_coloumn_desription extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'description', $this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('activity', 'description');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190206_124737_add_coloumn_desription cannot be reverted.\n";

        return false;
    }
    */
}
