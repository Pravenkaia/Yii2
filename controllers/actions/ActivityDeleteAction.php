<?php


namespace app\controllers\actions;


use Yii;
use yii\base\Action;
use yii\web\HttpException;

/**
 * Class ActivityDeleteAction
 * @package app\controllers\actions
 * Activity
 */
class ActivityDeleteAction extends Action
{
    public function run($id) {
        if(Yii::$app->user->isGuest) {
            throw new HttpException(401, 'Не авторизованный пользователь');
        }
       // echo 'id=' . $id . '<br>';

        if(Yii::$app->acts->deleteActivity($id)) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Activity\' ' . $id . ' been deleted .'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Error of deleting.'));
        }


        //$model = \Yii::$app->acts->getActivity($id);
        //if($model) {
        //    $model->delete();
        //}
       // echo '<pre>', var_dump($model); echo '</pre>';exit;
        //$models = Customer::find()->where('status = 3')->all();
        //foreach ($models as $model) {
        //    $model->delete();
        //}

        return Yii::$app->response->redirect(['activity']);
    }

}