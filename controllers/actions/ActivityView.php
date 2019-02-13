<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 12.02.2019
 * Time: 16:57
 */

namespace app\controllers\actions;


use yii\base\Action;
use yii\web\HttpException;

class ActivityView extends Action
{

    /**
     * @param $id
     * @return string
     * @throws HttpException
     */
    public function run($id) {

        if(\Yii::$app->user->isGuest) {
            throw new HttpException(401, 'Не авторизованный пользователь');
        }

        $model = \Yii::$app->acts->getActivity($id);
        //$t = !\Yii::$app->user->can('authorActivity',['activity' => $model]);
//var_dump($t);
        if (!\Yii::$app->user->can('authorActivity',['activity' => $model])
            && !\Yii::$app->user->can('admin')) {
            throw new HttpException(401, 'Не автор события');
        }
       // echo '<pre>'; var_dump($model); echo '<pre>'; exit;
        return $this->controller->render('view', ['model'=> $model]);
    }
}