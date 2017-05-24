<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'status')->dropDownList([
                User::STATUS_ACTIVE => Yii::t('user','Active'),
                User::STATUS_DELETED => Yii::t('user','Deleted')
            ]) ?>

    <?= $form->field($employee,'first_name')->textInput(); ?>

    <?= $form->field($employee,'last_name')->textInput(); ?>

    <?= $form->field($employee, 'function')->textInput(['maxlength' => true]) ?>

    <?= $form->field($employee, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($user->isNewRecord ? Yii::t('user', 'Create') : Yii::t('user', 'Update'), ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
