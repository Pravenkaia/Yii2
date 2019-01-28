<?php

use yii\db\Migration;

/**
 * Class m190128_161505_create_tables_activity_users
 */
class m190128_161505_create_tables_activity_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(150)->notNull(),
            'description'=>$this->text(),
            'dateStart'=>$this->dateTime()->notNull(),
            'dateEnd'=>$this->dateTime(),
            'isRepeatable'=>$this->boolean()->notNull()->defaultValue(0),
            'isBlocking'=>$this->boolean()->notNull()->defaultValue(0),
            'date_created'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('users',[
            'id'=>$this->integer()->notNull(),
            'email'=>$this->string(150)->notNull(),
            'password_hash'=>$this->string(300)->notNull(),
            'token'=>$this->string(300),
            'fio'=>$this->string(300),
            'date_created'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->addPrimaryKey('usersPK','users','id');

        $this->addColumn('activity','user_id',$this->integer()->notNull());

        $this->addForeignKey('activity_userFK',
            'activity','user_id','users','id'
        ,'CASCADE','CASCADE');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190128_161505_create_tables_activity_users cannot be reverted.\n";

        return false;
    }
    */
}
