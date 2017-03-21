<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Travel;

/**
 * TravelSearch represents the model behind the search form about `app\models\Travel`.
 */
class TravelSearch extends Travel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'transport_id', 'status'], 'integer'],
            [['title', 'desc', 'start_point', 'end_point', 'beg_date', 'end_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Travel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'beg_date' => $this->beg_date,
            'end_date' => $this->end_date,
            'transport_id' => $this->transport_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'start_point', $this->start_point])
            ->andFilterWhere(['like', 'end_point', $this->end_point]);

        return $dataProvider;
    }
}
