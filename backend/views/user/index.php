<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             'email:email',
             'status' => [
                     'filter' => [
                             User::STATUS_ACTIVE => Yii::t('user','Active'),
                            User::STATUS_DELETED => Yii::t('user','Deleted')
                     ],
                     'attribute' => 'status',
                    'value' => function($data){
                        if($data->status == User::STATUS_ACTIVE){
                            return Yii::t('user','Active');
                        }else{
                            return Yii::t('user','Deleted');
                        }
                    }
             ],
             'created_at:datetime',
             'updated_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'resetPassword' => function ($url, $model, $key) {
                            return Html::a('<i class=\'fa fa-key\'></i>', ['reset-password', 'id' => $model->id]);
                    },
                ],
                'template' => '{resetPassword}',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
