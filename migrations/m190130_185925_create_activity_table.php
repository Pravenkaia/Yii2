<?php

use yii\db\Migration;

/**
 * Handles the creation of table `activity`.
 */
class m190130_185925_create_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity', [
            'id_activity' => $this->primaryKey(),
            'id_author' => $this->integer(),
            'title' => $this->string(150)->notNull(),
            'date_start' => $this->dateTime()->notNull(),
            'date_end' => $this->dateTime(),
            'is_repeatable' => $this->boolean()->defaultValue(0),
            'is_blocking' => $this->boolean()->defaultValue(0),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            //'date_changed' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(200)->notNull(),
            'email' => $this->string(120)->notNull(),
            'password_hash' => $this->string(64)->notNull(),
            'token' => $this->string(300),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addColumn('activity', 'date_changed', $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'));

        $this->renameColumn('activity', 'id_author','id_user');

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
        $this->dropTable('users');
        $this->dropTable('activity');

        //echo 'm190130_185925_create_activity_table невозможно откатиться к предыдущей версии';
        //return false;

    }


}
