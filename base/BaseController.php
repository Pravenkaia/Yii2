<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:33
 */

namespace app\base;


use yii\web\Controller;

class BaseController extends Controller
{



        //Yii::$app->getSession()->setFlash('userPage', '127.0.0.1' . $_SERVER['REQUEST_URI']);

    public function afterAction($action, $result)
    {
        \Yii::$app->session->setFlash('userPage',\Yii::$app->request->url);
        return parent::afterAction($action, $result);
    }
}