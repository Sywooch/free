<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "transport".
 *
 * @property string $id
 * @property string $name
 *
 * @property Travel[] $travels
 */
class Transport extends ActiveRecord
{
    /**
     * const
     */
    const NAME_MAX_LENGTH = 45;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => self::NAME_MAX_LENGTH],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTravels()
    {
        return $this->hasMany(Travel::className(), ['transport_id' => 'id']);
    }
}
