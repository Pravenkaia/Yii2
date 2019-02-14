<?php

use yii\db\Migration;

/**
 * Class m190214_161957_update_auth_assign
 */
class m190214_161957_update_auth_assign extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        \Yii::$app->db->createCommand()->update('auth_assignment',
            ['user_id' => \Yii::$app->security->generatePasswordHash('123456')],
            ['id' => '25'])
            ->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m190214_161957_update_auth_assign cannot be reverted.\n";
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
        echo "m190214_161957_update_auth_assign cannot be reverted.\n";

        return false;
    }
    */
}
