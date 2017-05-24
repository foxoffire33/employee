<?php
use yii\helpers\Html;
?>

<tr>
    <td bgcolor="#ffffff" style="padding: 40px 40px 20px; text-align: center;">
        <h1 style="margin: 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #333333; font-weight: normal;"><?= \yii::t('mail','New account') ?></h1>
    </td>
</tr>
<p>
<tr>
    <td bgcolor="#ffffff" style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: center;">
        <p style="margin: 0;">
        <p><?= \Yii::t('mail','Hello') ?> <?= Html::encode($model->employee->fullName) ?>,</p>

        <p><?= \Yii::t('mail','Your account is created you can now login in with de credentials below') ?></p>

        <table>
            <tr>
                <td style="text-align: left;"><strong><?= \Yii::t('mail','Email') ?>:</strong></td>
                <td><?= $model->email ?></td>
            </tr>
            <tr>
                <td style="text-align: left;"><strong><?= \Yii::t('mail','Password') ?>:</strong></td>
                <td><?= $model->genaretedPassword; ?></td>
            </tr>
        </table>

        </p>
    </td>
</tr>
</p>