<?php
namespace app\modules\models\query;

use \yii\db\ActiveQuery;

class LikeQuery extends ActiveQuery
{
    /**
     * @param $travel_id
     * @return $this
     */
    public function withTravel($travel_id)
    {
        return $this->andWhere([
            'travel_id' => $travel_id
        ]);
    }

    /**
     * @param null $db
     * @return array|\yii\db\ActiveRecord[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @param null $db
     * @return array|null|\yii\db\ActiveRecord
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}