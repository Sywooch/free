<?php

namespace app\models;

use yii\base\Object;
use yii\web\IdentityInterface;

/**
 * Model class for user identity
 * @package app\models
 */
class UserIdentity extends Object implements IdentityInterface
{
    /**
     * @var
     */
    public $id;
    public $username;
    public $password_hash;
    public $email;
    public $reset_token;
    public $last_modified;
    public $birth_date;
    public $about;
    public $city;
    public $name;
    public $surname;
    public $image_id;
    public $auth_key;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = UserRepository::findOne(['id' => $id]);
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = UserRepository::findOne(['auth_key' => $token]);
        return isset($user) ? new static($user) : null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = UserRepository::findOne(['username' => $username]);
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates authorization token
     */
    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    /**
     * Generates password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->reset_token = \Yii::$app->security->generateRandomString();
    }

    /**
     * returns concatenated name, surname, if not empty, or username
     * @return string
     */
    public function getDisplayName()
    {
        $displayName = implode(' ', [$this->name, $this->surname]);
        return trim($displayName) ? $displayName : $this->username;
    }
}
