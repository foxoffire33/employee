<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = Yii::t('common', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('employee','Employee'),
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('employee', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('employee', 'Update');
?>
<div class="employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
