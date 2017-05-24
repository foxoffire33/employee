<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = Yii::t('common', 'Update {modelClass}:', [
    'modelClass' => Yii::t('notification','Notification'),
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('notification', 'Notifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('notification', 'Update');
?>
<div class="notification-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
