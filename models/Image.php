<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "image".
 *
 * @property string $id
 * @property string $path
 * @property string $created
 * @property string $travel_id
 * @property string $user_id
 *
 * @property Travel $travel
 * @property UserRepository $user
 */
class Image extends ActiveRecord
{
    /**
     * const
     */
    const PATH_MAX_LENGTH = 255;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'user_id'], 'required'],
            [['created'], 'safe'],
            [['travel_id', 'user_id'], 'integer'],
            [['path'], 'string', 'max' => self::PATH_MAX_LENGTH],
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
            'id' => 'ID',
            'path' => 'Path',
            'created' => 'Created',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(UserRepository::className(), ['image_id' => 'id']);
    }
}
