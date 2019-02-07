<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 04.02.2019
 * Time: 16:46
 */

namespace app\controllers;


use app\components\RbacComponent;
use app\base\BaseController;

class RbacController extends BaseController
{
    public function actionGen() {
        $rbac = \Yii::$app->rbac;
        $rbac->generateRules();

        //return $this->render('gen');
        return $this->render('gen');

    }
}