<?php

namespace app\modules\models;

use app\models\Travel;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "like".
 *
 * @property string $id
 * @property string $user_id
 * @property string $created
 * @property string $travel_id
 *
 * @property Travel $travel
 */
class Like extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'travel_id'], 'required'],
            [['travel_id'], 'unique', 'targetAttribute' => ['user_id', 'travel_id']],
            [['user_id', 'travel_id'], 'integer'],
            [['created'], 'safe'],
            [['travel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Travel::className(), 'targetAttribute' => ['travel_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'created' => 'Created',
            'travel_id' => 'Travel ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTravel()
    {
        return $this->hasOne(Travel::className(), ['id' => 'travel_id']);
    }

    /**
     * @return query\LikeQuery
     */
    public static function find()
    {
        return new query\LikeQuery(get_called_class());
    }
}
