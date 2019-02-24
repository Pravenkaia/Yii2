<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 08.02.2019
 * Time: 17:56
 */

namespace app\controllers;


use app\base\BaseController;
use app\models\Users;


class UsersController extends BaseController
{

    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) :
            $id = \Yii::$app->user->identity->getId();

            $model = new Users();
            $model = Users::find()->where(['id' => $id])->limit(1)->one();
            return $this->render('index', ['model' => $model]);
        endif;
        return \Yii::$app->response->redirect(['/auth/sign-in']);
    }
}