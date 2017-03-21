<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TravelHasUser;

/**
 * TravelHasUserSearch represents the model behind the search form about `app\models\TravelHasUser`.
 */
class TravelHasUserSearch extends TravelHasUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['travel_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     *
     * bypass scenarios() implementation in the parent class
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     *
     * add conditions that should always apply here
     *
     * uncomment the following line if you do not want to return any records when validation fails
     * $query->where('0=1');
     *
     * grid filtering conditions
     */
    public function search($params)
    {
        $query = TravelHasUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'travel_id' => $this->travel_id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
