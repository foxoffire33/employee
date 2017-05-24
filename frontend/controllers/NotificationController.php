<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 2-5-17
 * Time: 15:06
 */

namespace frontend\controllers;

use frontend\models\search\NotificationSearch;
use common\models\Notification;
use yii\web\Controller;
use yii;
use yii\filters\AccessControl;


class NotificationController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search(['NotificationSearch' => ['user_id' => Yii::$app->user->id]]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new Notification();
        $model->setAttribute('user_id', yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->sendMail();
            Yii::$app->session->setFlash('success',Yii::t('notification','Notification has been saved'));
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }
}