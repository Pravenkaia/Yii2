<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 03.02.2019
 * Time: 17:43
 */

namespace app\controllers;


use app\base\BaseController;
use app\models\UsersAuth;
use Yii;
use yii\base\Exception;
use yii\helpers\VarDumper;

class AuthController extends BaseController
{

    public function actionIndex()
    {
        $id = Yii::$app->user->identity->getId();

        if ($id > 0) {
            $model = UsersAuth::find()->where(['id' => $id])->limit(1)->one();
            return $this->render('default', ['model' => $model]);
        }
        return Yii::$app->response->redirect(['/auth/sign-in']);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function actionSignUp()  //через UserComponent
    {
        $model = new UsersAuth();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            // $reg_users = Yii::$app->users; // UsersComponent

            if ($model->registration()) {

                Yii::$app->session->setFlash('success', Yii::t('app', 'New user is registered: id={name}', [
                    'name' => $model->id,
                ]));
                return Yii::$app->response->redirect(['/auth/sign-in']);//, 'id' => $model->id
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Error. User is not registered.'));
            }
        }

        return $this->render('sign-up', ['model' => $model]);
    }


    /**
     * @return string
     */
    public function actionSignIn()// через сущность Users
    {
        $model = new UsersAuth();
        if (!Yii::$app->user->isGuest)
            return Yii::$app->response->redirect(['/auth']);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if ($model->auth()) {
                Yii::$app->session->setFlash('success', 'Пользователь авторизован ' . $model->id);
                return Yii::$app->response->redirect(['/auth']);//, 'id' => $model->id
            } else {
                //echo '<pre>$model<br>'; VarDumper::dump($model); echo '<pre>';exit;
                Yii::$app->session->setFlash('error', 'Ошибка авторизации');
            }
        }

        return $this->render('signin', ['model' => $model]);
    }


}