<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('user', 'Update {modelClass}:', [
    'modelClass' => Yii::t('user','User'),
]) . $user->email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->email, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
        'employee' => $employee
    ]) ?>

</div>
