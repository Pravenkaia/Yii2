<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 02.02.2019
 * Time: 12:16
 */

namespace app\controllers;


use app\base\BaseController;
use app\components\DaoComponent;

class DaoController extends BaseController
{
    /**
     * @param int $id_user
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionIndex($id_user = 1) {
        /**
         * @var DaoComponent $dao
         */
        $dao = \Yii::$app->dao;

        //$dao->queryTransact();

        return $this->render('index', [
            'users' => $dao->getAllUsers(),
            'activities' => $dao->getAllActivities(),
            'cnt' => $dao->getCountActivities($id_user),
            'auth' => $dao->getAuthItem()
            ]);
    }


}