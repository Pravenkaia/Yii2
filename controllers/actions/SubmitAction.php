<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 28.01.2019
 * Time: 17:29
 */

namespace app\controllers\actions;

use app\components\ActivityComponent;
use Yii;
use yii\base\Action;
use yii\web\UploadedFile;
use app\models\Activity;
use yii\helpers\VarDumper;


class SubmitAction extends Action
{
    public $settings;

    /**
     * @return string
     * @throws \yii\web\HttpException
     */
    public function run()
    {

        $view = 'submit';
        $setFlash = '';
        $activity = new Activity();

        if (\Yii::$app->user->isGuest):
            $view = 'form';
            \Yii::$app->session->setFlash('error', 'Только для авторизованных пользователей');
        else:

            $activity->id_user = \Yii::$app->user->identity->getId();

            /**
             * компонент
             * @var ActivityComponent $acts
             */
            $acts = \Yii::$app->acts;


            if (\Yii::$app->request->isPost) {
                $activity->load(\Yii::$app->request->post());



                $acts->formatDates($activity);  //форматирует даты начала и конца события и названия файла для бд

                //echo '$activity->title: ' . $activity->title;
                //echo '<br><pre>'; VarDumper::dump($activity); echo '</pre>'; exit;


                //$activity->document_file = UploadedFile::getInstance($activity, 'document_file');
                //
                //if ($activity->document_file) { //документ загружен
                //    $activity->document = $acts->upload_docs($activity);
                //    if ($activity->upload($activity->document_file)) {
                //        //$activity->document = $activity->document->getBaseName();
                //        $setFlash = '<br>Успешная загрузка файлов.';
                //    }
                //};


                if ($activity->save()) {
                    $setFlash .= 'Успешное сохранение<br>';
                    if ($setFlash != '')
                      //  \Yii::$app->session->setFlash('success', $setFlash . $activity->id_user);

                    return $this->controller->redirect('view', ['model' => $activity, 'id' => $activity->id_activity]);
                }

                // else {
                //    $activity->addError('id_activity','Ошибка сохранения в БД.');
                //};

            }
            // } else {
            //    //'Ошибка. Вы перешли не из формы ввода События.';
            //
            // }
        endif;
        if ($setFlash != '')
            \Yii::$app->session->setFlash('success', $setFlash . $activity->id_user);
        // \Yii::$app->view->params['settings'] = $this->settings;
        return $this->controller->render($view, ['model' => $activity]);

    }
}