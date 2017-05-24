<tr>
    <td bgcolor="#ffffff" style="padding: 40px 40px 20px; text-align: center;">
        <h1 style="margin: 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #333333; font-weight: normal;"><?= yii::t('mail', 'Status change from notification') ?></h1>
    </td>
</tr>
<tr>
    <td bgcolor="#ffffff"
        style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: center;">
        <p style="margin: 0;">
            <?php if (Yii::$app->language == 'nl-NL'): ?>
                <?= $this->render('information', ['model' => $model]); ?>
            <?php endif; ?>
        </p>
    </td>
</tr>

<!-- 1 Column Text + Button : END -->

<!-- Background Image with Text : BEGIN -->
<tr>
    <!-- Bulletproof Background Images c/o https://backgrounds.cm -->
    <td background="http://placehold.it/600x230/222222/666666" bgcolor="#222222" valign="middle"
        style="text-align: center; background-position: center center !important; background-size: cover !important;">

        <!--[if gte mso 9]>
        <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false"
                style="width:600px;height:175px; background-position: center center !important;">
            <v:fill type="tile" src="http://placehold.it/600x230/222222/666666" color="#222222"/>
            <v:textbox inset="0,0,0,0">
        <![endif]-->
        <div>
            <table role="presentation" aria-hidden="true" align="center" border="0" cellpadding="0" cellspacing="0"
                   width="100%">
                <tr>
                    <td valign="middle"
                        style="text-align: center; padding: 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #ffffff;">
                        <p style="margin: 0;"><?= $model->description ?></p>
                    </td>
                </tr>
            </table>
        </div>
        <!--[if gte mso 9]>
        </v:textbox>
        </v:rect>
        <![endif]-->
    </td>
</tr>
<!-- Background Image with Text : END -->
