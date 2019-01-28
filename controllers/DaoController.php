<?php
/**
 * Created by PhpStorm.
 * User: Talisman
 * Date: 28.01.2019
 * Time: 19:53
 */

namespace app\controllers;


use app\base\BaseController;
use app\components\DaoComponent;
use yii\web\Controller;

class DaoController extends BaseController
{
    public function actionIndex(){
        /** @var DaoComponent $dao */
        $dao=\Yii::$app->dao;

        $dao->queryTransact();
//        echo 'done';
//        exit;

        $users=$dao->getAllUsers();

        $activity_user=$dao->getActivityUser(\Yii::$app->request->get('id','1'));

        $any_activity=$dao->getAnyActivity();
        $cnt_activity=$dao->getCountActivity();
        $activity_filter=$dao->getActivityFilter();
        return $this->render('index',['activity_filter'=>$activity_filter,'cnt'=>$cnt_activity,'any_activity'=>$any_activity,'users'=>$users,'activity_user'=>$activity_user]);
    }
}