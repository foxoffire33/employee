<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Login form
 */
class LoginForm extends \common\models\LoginForm
{

    private $_user;

    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if (Yii::$app->authManager->checkAccess($user->id, 'Manager')) {
                return Yii::$app->user->login($this->getUser($user), $this->rememberMe ? 3600 * 24 * 30 : 0);
            }else{
                $this->addError('email',Yii::t('user','Your account is not allowed to login to this section of the webpage'));
            }
        }
        return false;
    }
}