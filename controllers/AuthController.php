<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 03.02.2019
 * Time: 17:43
 */

namespace app\controllers;


use app\base\BaseController;
use app\models\Users;

class AuthController extends BaseController
{

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionSignUp() {
        $model = new Users();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $model->setScenarioRegister();
            if ($model->registration()) {
                \Yii::$app->session->setFlash('success', 'Создан новый пользователь ' . $model->id);
            }
            else {
                \Yii::$app->session->setFlash('error', 'Пользователь не создан. Ошибка регистрации');
            }
        }

        return $this->render( 'signup',['model' => $model]);

    }

    /**
     * @return string
     */
    public function actionSignIn() {
        $model = new Users();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->auth()) {
                \Yii::$app->session->setFlash('success', 'Пользователь авторизован ' . $model->id);
            }
            else {
                \Yii::$app->session->setFlash('error', 'Ошибка авторизации');
            }
        }

        return $this->render('signin', ['model' => $model]);
    }


}