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

    public function actionIndex()
    {
        $id = \Yii::$app->user->identity->getId();

        if ($id > 0) {
            $model = new Users();
            $model = Users::find()->where(['id' => $id])->limit(1)->one();
            return $this->render('default', ['model' => $model]);
        }
        return \Yii::$app->response->redirect(['/auth/sign-in']);
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionSignUp()  //через UserComponent
    {
        $model = new Users();


        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $reg_users = \Yii::$app->users; // UsersComponent

           //if ($reg_users->isUserByEmail($model)) :
           //    $this->addError('email', 'Такой email уже есть');
           //else:
                if ($reg_users->registration($model)) {

                    if ($model->save()) {
                        \Yii::$app->session->setFlash('success', 'Создан новый пользователь ' . $model->id);
                        return \Yii::$app->response->redirect(['/auth/sign-in']);//, 'id' => $model->id
                    } else {
                        \Yii::$app->session->setFlash('error', 'Пользователь не создан. Ошибка регистрации');
                    }

                };
            //endif;
        }


        return $this->render('signup', ['model' => $model]);

    }


    /**
     * @return string
     */
    public function actionSignIn()// через сущность Users
    {
        $model = new Users();
        if (!\Yii::$app->user->isGuest)
            return \Yii::$app->response->redirect(['/auth']);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->auth()) {
                \Yii::$app->session->setFlash('success', 'Пользователь авторизован ' . $model->id);
                return \Yii::$app->response->redirect(['/auth']);//, 'id' => $model->id
            } else {
                \Yii::$app->session->setFlash('error', 'Ошибка авторизации');
            }
        }

        return $this->render('signin', ['model' => $model]);
    }


}