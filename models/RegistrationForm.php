<?php

namespace app\models;

use yii\base\Model;

class RegistrationForm extends Model
{
    /**
     * @const
     */
    const USERNAME_MAX_LENGTH = 45;
    const PASSWORD_MAX_LENGTH = 255;

    /**
     * @var
     */
    public $username;
    public $password;
    public $email;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'safe'],
            [['username', 'password', 'email'], 'required'],
            [['username'], 'string', 'max' => self::USERNAME_MAX_LENGTH],
            [['password'], 'string', 'max' => self::PASSWORD_MAX_LENGTH],
            [['email'], 'email'],
            [['email'], 'unique', 'skipOnError' => true, 'targetClass' => UserRepository::className(), 'targetAttribute' => ['email' => 'email']]
        ];
    }
}