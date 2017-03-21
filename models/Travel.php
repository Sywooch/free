<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\modules\models\Like;
use app\modules\models\Post;

/**
 * This is the model class for table "travel".
 *
 * @property string $id
 * @property string $title
 * @property string $desc
 * @property string $start_point
 * @property string $end_point
 * @property string $user_id
 * @property string $beg_date
 * @property string $end_date
 * @property string $transport_id
 * @property integer $status
 *
 * @property Image[] $images
 * @property Like[] $likes
 * @property Post[] $posts
 * @property Transport $transport
 * @property UserRepository $user
 * @property TravelHasUser[] $travelHasUsers
 * @property UserRepository[] $users
 */
class Travel extends ActiveRecord
{
    /**
     * const
     */
    const START_END_POINT_MAX_LEN = 100,
        TITLE_MAX_LEN = 45,
        DESC_MAX_LEN = 2000;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'travel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'start_point', 'end_point', 'user_id', 'transport_id'], 'required'],
            [['user_id', 'transport_id', 'status'], 'integer'],
            [['beg_date', 'end_date'], 'safe'],
            [['title'], 'string', 'max' => self::TITLE_MAX_LEN],
            [['desc'], 'string', 'max' => self::TITLE_MAX_LEN],
            [['start_point', 'end_point'], 'string', 'max' => self::START_END_POINT_MAX_LEN],
            [['transport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transport::className(), 'targetAttribute' => ['transport_id' => 'id']],
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
            'title' => 'Title',
            'desc' => 'Description',
            'start_point' => 'Start Point',
            'end_point' => 'End Point',
            'user_id' => 'User ID',
            'beg_date' => 'Begin Date',
            'end_date' => 'End Date',
            'transport_id' => 'Transport ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['travel_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['travel_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['travel_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransport()
    {
        return $this->hasOne(Transport::className(), ['id' => 'transport_id']);
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
    public function getTravelHasUsers()
    {
        return $this->hasMany(TravelHasUser::className(), ['travel_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(UserRepository::className(), ['id' => 'user_id'])->viaTable('travel_has_user', ['travel_id' => 'id']);
    }
}