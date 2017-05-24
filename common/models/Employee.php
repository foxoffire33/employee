<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class Employee extends \common\components\db\ActiveRecord
{

    const SCENARIO_CREATED_WITH_USER = 'created_with_user_form';

    public $fullname;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATED_WITH_USER] = ['first_name', 'last_name','function','phone', 'created_at', 'updated_at'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name','function','phone'], 'required','on' => self::SCENARIO_DEFAULT],
            [['first_name', 'last_name','function','phone'], 'required','on' => self::SCENARIO_CREATED_WITH_USER],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 128],
            [['user_id'], 'unique','on' => [self::SCENARIO_DEFAULT,self::SCENARIO_CREATED_WITH_USER]],
            [['first_name','last_name','phone','user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function getFullName(){
        return $this->first_name . ', ' . $this->last_name;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('employee', 'ID'),
            'user_id' => Yii::t('employee', 'User ID'),
            'first_name' => Yii::t('employee', 'First Name'),
            'last_name' => Yii::t('employee', 'Last Name'),
            'function' => Yii::t('employee', 'Function'),
            'phone' => Yii::t('employee', 'Phone'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
