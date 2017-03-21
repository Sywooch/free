<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "auth".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $source
 * @property string $source_id
 *
 * @property UserRepository $user
 */
class Auth extends ActiveRecord
{
    /**
     * const
     */
    const SOURCE_SOURCE_ID_MAX_LENGTH = 255;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'source', 'source_id'], 'required'],
            [['user_id'], 'integer'],
            [['source', 'source_id'], 'string', 'max' => self::SOURCE_SOURCE_ID_MAX_LENGTH],
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
            'user_id' => 'User ID',
            'source' => 'Source',
            'source_id' => 'Source ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserRepository::className(), ['id' => 'user_id']);
    }
}
