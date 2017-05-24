
<?php
use yii\helpers\Html;

?>

<tr>
    <td bgcolor="#ffffff" style="padding: 40px 40px 20px; text-align: center;">
        <h1 style="margin: 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #333333; font-weight: normal;"><?= \yii::t('mail','Password Reset Token') ?></h1>
    </td>
</tr>
<tr>
    <td bgcolor="#ffffff" style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: center;">
        <p style="margin: 0;">
        <p><?= Yii::t('mail','Hello') ?> <?= Html::encode($user->employee->fullName) ?>,</p>

        <p><?= Yii::t('mail','Press the button below to reset your password') ?></p>

        </p>
    </td>
</tr>
<td bgcolor="#ffffff" style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
    <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
        <tr>
            <td style="width: 30px"></td>
            <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td">
                <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]); ?>" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff;"><?= \Yii::t('mail','Password reset') ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
            </td>
            <td style="width: 30px"></td>
        </tr>
    </table>
    <!-- Button : END -->
</td>
<!-- 1 Column Text + Button : END -->