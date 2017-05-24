<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\NotificationType;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('notification', 'Notifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'status' => [
                'attribute' => 'status',
                'contentOptions' => function($data){
                    return ['class' => $data->statusClass];
                },
                'value' => function($data){
                    return $data->statusText;
                }
            ],
            ['class' => 'yii\grid\SerialColumn'],
            'type_id' => [
                    'attribute' => 'type_id',
                    'value' => function($data){
                        return $data->type->name;
                    }
            ],
            'description' => [
                'attribute' => 'description',
                'value' => function($data){
                    if(!is_null($data->description)){
                        return substr($data->description,0,100).'...';
                    }
                }
            ],
            'start_datetime:date',
            'end_datetime:date',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
