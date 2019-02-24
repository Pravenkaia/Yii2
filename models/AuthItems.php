<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 18.02.2019
 * Time: 17:47
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * Class AuthItems
 * @package app\models
 */
class AuthItems extends AuthItem
{
    /**
     * @return array|ActiveRecord[]
     * @throws NotFoundHttpException
     */
    public function getAuthNames()
    {
        //массив вида [i => ['name']]
        $authNames = $this->find()->select('name')->where(['type' => '1'])->orderBy('name')->asArray()->all();
        //echo '<pre>'; var_dump($t); echo '</pre>';exit;
        if ($authNames !== null) {
            //приводим массив к виду ['name' => 'name'] // ключ = значению
            foreach ($authNames as $authName) {
                $items[$authName['name']] = $authName['name'];
            }
            if (isset($items)) {
                //echo '<pre>';var_dump($items); echo '<pre>'; exit;
                return $items;
            }
        }

        throw new NotFoundHttpException(Yii::t('app', 'Can\'t find array of role. The requested page does not exist.'));
    }
}