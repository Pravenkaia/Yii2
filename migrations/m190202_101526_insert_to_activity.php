<?php

use yii\db\Migration;

/**
 * Class m190202_101526_insert_to_activity
 */
class m190202_101526_insert_to_activity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $users = [1,25];
        $i=0;
        $data_array =[];
        while($i <= 10){
             \yii\helpers\ArrayHelper::setValue($data_array, $i, [
                'id_user' => $users[array_rand($users)],
                'title' => 'title' . $i++,
                'date_start' => '2019-05-0' . $i . ' 00:00:00',
                'date_end' => '2019-05-0' . $i . ' 00:00:00']);
        }
        Yii::$app->db->createCommand()->batchInsert( 'activity', ['id_user','title', 'date_start', 'date_end'],
            $data_array
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190202_101526_insert_to_activity cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190202_101526_insert_to_activity cannot be reverted.\n";

        return false;
    }
    */
}
