<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ActivityBase]].
 *
 * @see ActivityBase
 */
class ActivityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ActivityBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ActivityBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
