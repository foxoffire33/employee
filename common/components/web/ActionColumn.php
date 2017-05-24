<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 9-5-17
 * Time: 14:59
 */

namespace common\components\web;


class ActionColumn extends \yii\grid\ActionColumn
{
    public $template = '{update}{delete}';
}