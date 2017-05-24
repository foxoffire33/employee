<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('notification', 'Notifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('notification', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('notification', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('notification', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'type_id' => [
                    'attribute' => 'type_id',
                    'value' => function($data){
                        return $data->type->name;
                    }
            ],
            'user_id' => [
                'attribute' => 'user_id',
                'value' => function($data){
                    return $data->user->employee->fullName;
                }
            ],
            'start_datetime:date',
            'end_datetime:date',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <div class="text-info">
        <?= $model->description ?>
    </div>

</div>
