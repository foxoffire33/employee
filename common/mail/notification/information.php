<table>
    <tr>
        <td style="text-align: left;"><strong><?= Yii::t('mail','Who') ?>:</strong></td>
        <td><?= $model->user->employee->fullName ?></td>
    </tr>
    <tr>
        <td style="text-align: left;"><strong><?= Yii::t('mail','Type') ?>:</strong></td>
        <td><?= $model->type->name ?></td>
    </tr>
    <tr>
        <td style="text-align: left;"><strong><?= Yii::t('mail','Status') ?>:</strong></td>
        <td><?= $model->statusText ?></td>
    </tr>
    <tr>
        <td style="text-align: left;"><strong><?= Yii::t('mail','Start date') ?>:</strong></td>
        <td><?= (new \DateTime($model->start_datetime))->format('d M Y') ?></td>
    </tr>
    <?php if (!is_null($model->end_datetime)): ?>
        <tr>
            <td style="text-align: left;"><strong><?= Yii::t('mail','End date') ?>:</strong></td>
            <td><?= (new \DateTime($model->end_datetime))->format('d M Y') ?></td>
        </tr>
    <?php endif; ?>
</table>