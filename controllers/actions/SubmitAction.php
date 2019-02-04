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

class SubmitAction extends Action
{
    public function run()
    {

        $activity = new Activity();

        if (Yii::$app->request->isPost) {
            $activity->load(Yii::$app->request->post());

            $activity->document = UploadedFile::getInstance($activity, 'document');
            if ($activity->upload()) {
                //return $this->controller->render('index',['model'=>$activity]);
                return $this->controller->render('submit', ['model' => $activity]);
            }
        } else {
            $activity->arrayErrors[] = 'Ошибка. Вы перешли не из формы ввода События.';
            return $this->controller->render('index', ['model' => $activity]);
        }
    }
}