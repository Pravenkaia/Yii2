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
use app\models\UsersUpdate;
use Yii;


class UsersController extends BaseController
{

    /**
     * @return string|\yii\console\Response|\yii\web\Response
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) :
            $id = Yii::$app->user->identity->getId();

            $model = UsersUpdate::findIdentity($id);
            //echo '<pre>'; var_dump($model); '</pre>'; exit;

            if (Yii::$app->request->isPost) {
                $model->load(Yii::$app->request->post());

                // echo '<pre>'; var_dump($model); '</pre>'; exit;

                //проверяем пароль пользователя
                if ($model->passwordValidator()) :

                    //если новый пароль, создаём новый Hash
                    if ($model->new_password) {
                        $model->password_hash = $model->getPassHash($model->new_password);
                    };
                    //echo '<pre>'; var_dump($model); '</pre>'; exit;

                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', Yii::t('app', 'Data\'s been updated'));
                    } else {
                        Yii::$app->session->setFlash('error', Yii::t('app', 'Error. Data hasn\'t been updated'));
                    };
                else:
                    // разлогиниваем и перенапраляем
                    Yii::$app->user->logout();
                    return Yii::$app->response->redirect(['/auth/sign-in']);
                endif;
            };

            return $this->render('index', ['model' => $model]);

        endif;
        return Yii::$app->response->redirect(['/auth/sign-in']);
    }


}