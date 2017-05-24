<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 9-5-17
 * Time: 14:41
 */

namespace common\components\web;


class GridView extends \yii\grid\GridView
{

    public function renderTableRow ( $model, $key, $index ){
        //set row Options
        $this->rowOptions = ['id' => $model['id'], 'onclick' => 'window.location.href = \'view/?id='.$model['id']. '\''];

        //run normal tii2 function
        return parent::renderTableRow( $model, $key, $index );
    }

}