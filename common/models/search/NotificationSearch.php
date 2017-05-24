<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notification;

/**
 * NotificationSearch represents the model behind the search form about `common\models\Notification`.
 */
class NotificationSearch extends Notification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id','status'], 'integer'],
            [['start_datetime', 'end_datetime', 'description', 'created_at', 'updated_at','user_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Notification::find();
        $query->joinWith('user.employee');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'notification.id' => $this->id,
            'notification.type_id' => $this->type_id,
            'notification.status' => $this->status,
            'notification.start_datetime' => $this->start_datetime,
            'notification.end_datetime' => $this->end_datetime,
            'notification.created_at' => $this->created_at,
            'notification.updated_at' => $this->updated_at,
        ]);

        if(!is_int($this->user_id)){
            $query->andFilterWhere(['like','employee.first_name',$this->user_id])
                ->orFilterWhere(['like','employee.last_name',$this->user_id]);
        }


        $query->andFilterWhere(['like', 'notification.description', $this->description]);

        return $dataProvider;
    }
}
