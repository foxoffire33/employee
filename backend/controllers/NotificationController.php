<?php

namespace backend\controllers;

use Yii;
use common\models\Notification;
use common\models\search\NotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UnauthorizedHttpException;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends Controller
{

    public function beforeAction($action)
    {
        if(Yii::$app->user->can('Manager')){
            return parent::beforeAction($action);
        }
        $this->redirect('/site/login');
    }

    /**
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notification model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Notification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            //todo deze workaround vervangen
            $model->start_datetime = date("m/d/Y",time($model->start_datetime));
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionChangeStatus($status, $id)
    {
        $model = Notification::find()->where(['id' => $id, 'status' => Notification::STATUS_WAITING])->one();


        if(!is_null($model)) {
            $model->setAttribute('status', $status);
            if ($model->save()) {
                Yii::$app->mailer->compose('notification/statusUpdate',['model' => $model])
                    ->setFrom([yii::$app->params['managerEmail'] => yii::$app->params['managerEmail']])
                    ->setTo([$model->user->email => $model->user->employee->fullName])
                    ->setBcc(['reinier@paradigm050.com' => 'Reinier de la Parra'])
                    ->setSubject(Yii::t('notification','Status has changed to:' . $model->statusText))
                    ->send();
                Yii::$app->session->setFlash('success', Yii::t('notification','updated status to {statusText}',['statusText' => $model->statusText]));
            } else {
                yii::$app->session->setFlash('danger', 'can\'t update status');
            }
            $this->redirect('index');
        }else {
            throw new NotFoundHttpException(Yii::t('notification','can\'t find this Notification. you can only update it ones'));
        }
    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
