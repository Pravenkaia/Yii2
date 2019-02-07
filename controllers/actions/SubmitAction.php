<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 28.01.2019
 * Time: 17:29
 */

namespace app\controllers\actions;

use Yii;
use yii\base\Action;
use yii\web\UploadedFile;
use app\models\Activity;
use yii\helpers\VarDumper;


class SubmitAction extends Action
{

    /**
     * @return string
     * @throws \yii\web\HttpException
     */
    public function run()
    {

        $activity = new Activity();
        $setFlash = '';

       // echo '$activity->title: ' . $activity->title; exit;
        //echo '<pre>'. VarDumper::dump($activity); echo '</pre>';

        if (Yii::$app->request->isPost) {
            $activity->load(Yii::$app->request->post());

            $activity->formatDates();  //форматирует даты для бд (app\models\Activity;)

            if (!\Yii::$app->user->isGuest)
                $activity->id_user = \Yii::$app->user->getId();
            else $activity->id_user = 0;

            if ($activity->id_user > 0) :
                $activity->document = UploadedFile::getInstance($activity, 'document');
                if ($activity->document) { //документ загружен
                    if ($activity->upload()) {
                        $activity->document = $activity->document->getBaseName();
                        $setFlash = 'Успешная загрузка файлов.<br>';
                    }
                };
                if ($activity->save()) {
                    $setFlash .= 'Успешное сохранение<br>';
                    \Yii::$app->session->setFlash('success', $setFlash . $activity->id_user);
                } else {
                    $activity->arrayErrors[] = 'Ошибка сохранения.';
                };
            else:
                $activity->arrayErrors[] = 'ID пользователя не определен';
            endif;
        } else {
            $activity->arrayErrors[] = 'Ошибка. Вы перешли не из формы ввода События.';

        }
        return $this->controller->render('submit', ['model' => $activity]);
    }
}