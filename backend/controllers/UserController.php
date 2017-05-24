<?php

namespace backend\controllers;

use common\models\Employee;
use Yii;
use common\models\User;
use common\models\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UnauthorizedHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if(Yii::$app->user->can('manageUser')){
            return parent::beforeAction($action);
        }
        //throw new UnauthorizedHttpException(Yii::t('common','You are not allowed to view this page'));
        throw new NotFoundHttpException(Yii::t('common','Page not found'));
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = new User();
        $employee = new Employee();

        if(($user->load(Yii::$app->request->post()) && $employee->load(Yii::$app->request->post()))){
            $employee->setScenario(Employee::SCENARIO_CREATED_WITH_USER);
            if(($user->validate() && $employee->validate())){
                if($user->save(false)){
                    $employee->setAttribute('user_id',$user->id);
                    if($employee->save(false)){
                        \Yii::$app->mailer->compose('user/newUser', ['model' => $user])
                            ->setFrom([\Yii::$app->params['managerEmail'] => \Yii::$app->params['managerName']])
                            ->setTo($user->email)
                            ->setSubject(\Yii::t('mail','New account'))
                            ->send();
                        return $this->redirect(['view', 'id' => $user->id]);
                    }
                }
            }
        }

            return $this->render('create', [
                'user' => $user,
                'employee' => $employee
            ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $employee = $user->employee;

        if (($user->load(Yii::$app->request->post()) && $employee->load(Yii::$app->request->post()))) {
            $employee->setScenario(Employee::SCENARIO_CREATED_WITH_USER);
            if (($user->save() && $employee->save())) {
                return $this->redirect(['view', 'id' => $user->id]);
            }
        }
        return $this->render('update', [
            'user' => $user,
            'employee' => $employee,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionResetPassword($id){
        $model = User::find()->where(['id' => $id,'status' => User::STATUS_ACTIVE])->one();
        if(!is_null($model)){
            $model->genaretedPassword = Yii::$app->security->generateRandomString(12);
            $model->setPassword($model->genaretedPassword);
            if($model->save()){
                Yii::$app->mailer->compose('user/newPassword',['model' => $model])
                    ->setFrom([yii::$app->params['managerEmail'] => yii::$app->params['managerEmail']])
                    ->setTo([$model->email => $model->employee->fullName])
                    ->setSubject(Yii::t('mail','New Password'))
                    ->send();
                Yii::$app->session->setFlash('success',Yii::t('user','sended a new password to {fullName}',['fullName' => $model->employee->fullName]));
            }else{
                Yii::$app->session->setFlash('danger',Yii::t('user','Can\'t send the new password'));
            }
        }
        $this->redirect('index');
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
