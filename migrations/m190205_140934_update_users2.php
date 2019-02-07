<?php

use yii\db\Migration;

/**
 * Class m190205_140934_update_users2
 */
class m190205_140934_update_users2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        \Yii::$app->db->createCommand()->update('users',
            ['password_hash' => \Yii::$app->security->generatePasswordHash('123456')],
            ['id' => '25'])
            ->execute();

        \Yii::$app->db->createCommand()->update('users',
            ['password_hash' => \Yii::$app->security->generatePasswordHash('123456')],
            ['id' => '1'])
            ->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190205_140934_update_users2 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190205_140934_update_users2 cannot be reverted.\n";

        return false;
    }
    */
}
