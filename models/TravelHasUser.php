<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "travel_has_user".
 *
 * @property string $travel_id
 * @property string $user_id
 *
 * @property Travel $travel
 * @property UserRepository $user
 */
class TravelHasUser extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'travel_has_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['travel_id', 'user_id'], 'required'],
            [['travel_id', 'user_id'], 'integer'],
            [['travel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Travel::className(), 'targetAttribute' => ['travel_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRepository::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'travel_id' => 'Travel ID',
            'user_id' => 'User ID',
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserRepository::className(), ['id' => 'user_id']);
    }
}