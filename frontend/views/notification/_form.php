<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\NotificationType;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(NotificationType::find()->asArray()->all(), 'id', 'name')) ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'start_datetime')->input('date'); ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'end_datetime')->input('date'); ?>
    </div>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('common', 'Create'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
