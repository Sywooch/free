<?php

namespace app\modules\models;

use yii\db\ActiveRecord;
use app\models\UserRepository;
use app\models\Travel;

/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string $user_id
 * @property string $travel_id
 * @property string $text
 * @property string $last_modified
 *
 * @property UserRepository $user
 * @property Travel $travel
 */
class Post extends ActiveRecord
{
    const TEXT_MAX_LEN = 1000;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'travel_id'], 'required'],
            [['user_id', 'travel_id'], 'integer'],
            [['last_modified'], 'safe'],
            [['text'], 'string', 'max' => self::TEXT_MAX_LEN],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRepository::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'travel_id' => 'Travel ID',
            'text' => 'Text',
            'last_modified' => 'Last modified',
        ];
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
    public function getTravel()
    {
        return $this->hasOne(Travel::className(), ['id' => 'travel_id']);
    }

    /**
     * @return query\PostQuery
     */
    public static function find()
    {
        return new query\PostQuery(get_called_class());
    }
}
