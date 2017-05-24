<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $rule = new \common\components\rbac\ManageOwn;
        $auth->add($rule);

// add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnEmployee = $auth->createPermission('updateOwnEmployee');
        $updateOwnEmployee->description = 'update own Employee information';
        $updateOwnEmployee->ruleName = $rule->name;
        $auth->add($updateOwnEmployee);

        $updateOwnNotification = $auth->createPermission('updateOwnNotification');
        $updateOwnNotification->description = 'update own Notification information';
        $updateOwnNotification->ruleName = $rule->name;
        $auth->add($updateOwnNotification);


        // add "createPost" permission
        $manageUser = $auth->createPermission('manageUser');
        $manageUser->description = 'Manager the User model';
        $auth->add($manageUser);

        $manageEmployee = $auth->createPermission('manageEmployee');
        $manageEmployee->description = 'Manager the Employee model';
        $auth->add($manageEmployee);

        $manageNotification = $auth->createPermission('manageNotification');
        $manageNotification->description = 'Manager the Notification model';
        $auth->add($manageNotification);

        $manageNotificationType = $auth->createPermission('manageNotificationType');
        $manageNotificationType->description = 'Manager the NotificationType model';
        $auth->add($manageNotificationType);

        // add "author" role and give this role the "createPost" permission
        $manager = $auth->createRole('Manager');
        $auth->add($manager);
        $auth->addChild($manager, $manageUser);
        $auth->addChild($manager, $manageEmployee);
        $auth->addChild($manager, $manageNotification);
        $auth->addChild($manager, $manageNotificationType);

        $employee = $auth->createRole('Employee');
        $auth->add($employee);

        $auth->addChild($updateOwnEmployee, $manageEmployee);
        $auth->addChild($updateOwnNotification, $manageNotification);

        $auth->addChild($employee, $updateOwnEmployee);
        $auth->addChild($employee, $updateOwnNotification);

    }
}