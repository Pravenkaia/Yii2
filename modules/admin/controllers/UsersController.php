<?php

namespace app\modules\admin\controllers;

use app\models\AuthAssign;
use app\models\AuthItems;
use Exception;
use Yii;
use app\models\Users;//UsersBase
use app\modules\admin\models\UsersSearch;
use yii\db\StaleObjectException;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->userRole = $this->getUserRole($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Exception
     */
    public function actionUpdate($id)
    {
        /**
         * объект Юзера по ID
         */
        $model = $this->findModel($id);

        /**
         * роль из модели AuthItems
         */
        $model->userRole = $this->getUserRole($id);
        /**
         * список доступных ролей
         */
        $roles = new AuthItems;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //echo '<pre>'; var_dump($model); echo '</pre>'; exit;

            //изменение роли юзера
            Yii::$app->authManager->revokeAll($model->id);
            Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->userRole),$model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        //echo '<pre>'; var_dump($roles->getAuthNames()); echo '</pre>'; exit;
        return $this->render('update', [
            'model' => $model,
            'roles' => $roles->getAuthNames(),//массив
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /**
     * @param $id
     * @return yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsersSearch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsersSearch::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the user role based on user id value.
     * If the role is not found in AuthAssign, a 404 HTTP exception will be thrown.
     * @param $id
     * @return string $userRole
     * @throws NotFoundHttpException
     */
    protected function getUserRole($id)
    {
        $userRole = AuthAssign::find()
            ->select('item_name')
            ->where(['user_id' => $id])
            ->one()
            ->item_name
        ;
        //echo '<pre>'; var_dump($userRole); echo '</pre>'; exit; //->item_name

        if ($userRole !== null) {
            return $userRole;
        }
        throw new NotFoundHttpException(Yii::t('app', 'Can\'t find user\'s role. The requested page does not exist.'));
    }


}
