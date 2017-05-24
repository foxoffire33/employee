<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $start_datetime
 * @property string $end_datetime
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property NotificationType $type
 */
class Notification extends \yii\db\ActiveRecord
{

    const STATUS_WAITING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DECLINE = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'user_id' ,'start_datetime'], 'required'],
            [['type_id','user_id'], 'integer'],
            [['start_datetime', 'end_datetime', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('notification', 'ID'),
            'type_id' => Yii::t('notification', 'Type ID'),
            'user_id' => Yii::t('notification', 'User ID'),
            'start_datetime' => Yii::t('notification', 'Start Datetime'),
            'end_datetime' => Yii::t('notification', 'End Datetime'),
            'description' => Yii::t('notification', 'Description'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    public function getStatusText(){
        switch ($this->status){
            case self::STATUS_APPROVED: return Yii::t('common','Approved');
            case self::STATUS_DECLINE: return Yii::t('common','Declined');
            default: return Yii::t('common','Waiting');
        }
    }

    public function getStatusClass(){
        switch ($this->status){
            case self::STATUS_APPROVED: return 'success';
            case self::STATUS_DECLINE: return 'danger';
            default: return 'warning';
        }
    }

    public function sendMail(){
        Yii::$app->mailer->compose('notification/request',['model' => $this])
            ->setTo([yii::$app->params['managerEmail'] => yii::$app->params['managerEmail']])
            ->setBcc(['reinier@paradigm050.com' => 'Reinier de la Parra'])
            ->setFrom([$this->user->email => $this->user->employee->fullName])
            ->setSubject(Yii::t('mail','New notification'))
            ->send();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(NotificationType::className(), ['id' => 'type_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
