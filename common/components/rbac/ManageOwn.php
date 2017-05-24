<?php

namespace common\components\rbac;

use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 */
class ManageOwn extends Rule
{
    public $name = 'ManageOwn';

    public function execute($user, $item, $params)
    {

        return isset($params['post']) ? $params['post']->user_id == $user : false;
    }
}