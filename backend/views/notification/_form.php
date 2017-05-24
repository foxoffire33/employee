<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\NotificationType;
use common\models\User;
use common\models\Notification;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->joinWith('employee')
        ->select(['id' => 'user.id', 'fullName' => 'concat(employee.first_name,", ",employee.last_name)'])
        ->asArray()
        ->all(), 'id', 'fullName')) ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(NotificationType::find()->asArray()->all(), 'id', 'name')) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'status')->dropDownList([
                Notification::STATUS_WAITING => Yii::t('common','Waiting'),
                Notification::STATUS_APPROVED => Yii::t('common','Approved'),
                Notification::STATUS_DECLINE => Yii::t('common','Declined'),
        ]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'start_datetime')->input('date'); ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'end_datetime')->input('date'); ?>
    </div>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
