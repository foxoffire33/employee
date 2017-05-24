<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 3-5-17
 * Time: 14:56
 */

namespace backend\controllers;

use common\models\Notification;
use yii\web\Controller;
use yii;

class EmailController extends Controller
{

    public function actionUpdate($id){
        $this->layout = '@common/mail/layouts/html';
        $model = Notification::find()->where(['id' => $id])->one();

        return $this->render('@common/mail/notification/statusUpdate',['model' => $model]);

    }

    public function actionNew($id){
        $this->layout = '@common/mail/layouts/html';
        $model = Notification::find()->where(['id' => $id])->one();

        //$model->sendMail();

        return $this->render('@common/mail/notification/request',['model' => $model]);

    }

}