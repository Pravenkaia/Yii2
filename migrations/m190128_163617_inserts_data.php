<?php

use yii\db\Migration;

/**
 * Class m190128_163617_inserts_data
 */
class m190128_163617_inserts_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',[
            'id'=>1,
            'email'=>'test@test.ru',
            'password_hash'=>'sdfsd',
        ]);
        $this->insert('users',[
            'id'=>2,
            'email'=>'test_two@test.ru',
            'password_hash'=>'sdfsd',
        ]);

        $data=[
            [1,'title 1',date('Y-m-d H:i:s')],
            [1,'title 1 2',date('Y-m-d H:i:s')],
            [1,'title 1 3',date('Y-m-d H:i:s')],
            [2,'title 2',date('2018-12-12 19:00:00')],
        ];

        $this->batchInsert('activity',['user_id','title','dateStart'],$data);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('activity');
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190128_163617_inserts_data cannot be reverted.\n";

        return false;
    }
    */
}
