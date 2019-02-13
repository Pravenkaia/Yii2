<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 06.02.2019
 * Time: 13:46
 */

namespace app\controllers\actions;


use yii\base\Action;
use app\models\Activity;
use yii\helpers\VarDumper;
use yii\web\HttpException;

/**
 * Class ActivityFormAction
 * @package app\controllers\actions
 */
class ActivityFormAction extends Action
{
    public $settings;


    /**
     * @return string
     * @throws HttpException
     */
    public function run()
    {
        $activity = new Activity();
        $view = 'form';

        $activity->array_errors = '';
        //определяем id_user
        if(\Yii::$app->user->isGuest) :
           // $this->settings = 'Только для авторизованных пользователей!';
            throw new HttpException(401, 'The user is not authorized');
           // \Yii::$app->session->setFlash('error', 'Только для авторизованных пользователей!');
        else:
        if(!\Yii::$app->user->can('createActivity')
            && !\Yii::$app->user->can('admin')) {
            throw new HttpException(401, 'User does not have permission');
        }
            $activity->id_user = \Yii::$app->user->identity->getId();


        if ($activity->validate()) { // успешная валидация данных
            //var_dump($activity->id_user); exit;
            $this->settings = 'Не пройдена валидация';

         // if ($activity->id_user > 0) : // пользователь имеет id

         //     if (\Yii::$app->request->isPost) {
         //         $activity->load(\Yii::$app->request->post());

         //         $activity->document = UploadedFile::getInstance($activity, 'document');
         //         if ($activity->upload()) {
         //             //return $this->controller->render('index',['model'=>$activity]);
         //             \Yii::$app->session->setFlash('success', 'Успешная загрузка файлов.' . $activity->id_user);
         //         }
         //         if ($activity->saveActivity()) {
         //             $activity->arrayErrors[] = 'Все сохранено.';
         //             $view = 'submit'; //return $this->controller->render('submit', ['model' => $activity]);
         //         } else {
         //             $activity->arrayErrors[] = 'Ошибка сохранения.';
         //             $view = 'submit'; //return $this->controller->render('submit', ['model' => $activity]);
         //         }
         //     } else {
         //         $activity->arrayErrors[] = 'Ошибка. Вы перешли не из формы ввода События.';
         //         \Yii::$app->session->setFlash('success', 'Ошибка. Вы перешли не из формы ввода События.' . $activity->id_user);
         //         $view = 'submit'; //return $this->controller->render('submit', ['model' => $activity]);
         //     };

         // else:  // у пользователя нет id
         //     \Yii::$app->session->setFlash('success', 'Ошибка авторизации!');
         //     \Yii::$app->view->params['settings'] = 'Ошибка авторизации!';
         // endif;


        }


        //echo $this->settings; exit;
        //    $attr = $activity->getAttributes();
        //    echo '<pre>';
        //    VarDumper::dump($attr);
        //    echo '</pre>';
        //     exit;
        endif;
        //\Yii::$app->view->params['settings'] = $this->settings;
        //return $this->controller->render('index', ['model' => $activity, 'settings' => $this->settings]);
        return $this->controller->render($view, ['model' => $activity]);
    }

}