<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\modules\models\Post;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string $reset_token
 * @property string $last_modified
 * @property string $birth_date
 * @property string $about
 * @property string $city
 * @property string $name
 * @property string $surname
 * @property string $image_id
 *
 * @property Image[] $images
 * @property Post[] $posts
 * @property Travel[] $travelsCreated
 * @property TravelHasUser[] $travelHasUsers
 * @property Travel[] $travelsTookPart
 * @property Image $image
 */
class UserRepository extends ActiveRecord
{
    /**
     * const
     */
    const PASSWORD_HASH_RESET_TOKEN_MAX_LEN = 100,
        STRING_FLD_MAX_LEN = 45,
        ABOUT_MAX_LEN = 1000;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],
            [['last_modified', 'birth_date'], 'safe'],
            [['image_id'], 'integer'],
            [['username', 'email', 'city', 'name', 'surname'], 'string', 'max' => self::STRING_FLD_MAX_LEN],
            [['password_hash', 'reset_token'], 'string', 'max' => self::PASSWORD_HASH_RESET_TOKEN_MAX_LEN],
            [['about'], 'string', 'max' => self::ABOUT_MAX_LEN],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'email' => 'E-mail',
            'reset_token' => 'Reset token',
            'last_modified' => 'Last Modified',
            'birth_date' => 'Date of birth',
            'about' => 'About',
            'city' => 'City',
            'name' => 'Name',
            'surname' => 'Surname',
            'image_id' => 'Image ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTravelsCreated()
    {
        return $this->hasMany(Travel::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTravelHasUsers()
    {
        return $this->hasMany(TravelHasUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTravelsTookPart()
    {
        return $this->hasMany(Travel::className(), ['id' => 'travel_id'])->viaTable('travel_has_user', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }
}