<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 18.02.2019
 * Time: 17:18
 */

namespace app\models;


use Yii;
use yii\web\NotFoundHttpException;

/**
 * Class AuthAssign
 * @package app\models
 */
class AuthAssign extends AuthAssignment
{
    /**
     * @param $id
     * @return array| yii\db\ActiveRecord|null
     * @throws NotFoundHttpException
     */
    public function getUserRole($id)
    {
        $userRole = AuthAssign::find()
            ->select('item_name')
            ->where(['user_id' => $id])
            ->one()
            ->item_name;
        //echo '<pre>'; var_dump($userRole->item_name); echo '</pre>'; exit;

        if ( $userRole !== null) {
            return $userRole;
        }
        throw new NotFoundHttpException(Yii::t('app', 'Can\'t find user\'s role. The requested page does not exist.'));
    }
}