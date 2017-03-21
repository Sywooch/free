<?php

namespace app\components;

use app\models\Auth;
use app\models\UserIdentity;
use app\models\UserRepository;
use yii\helpers\ArrayHelper;
use yii\authclient\ClientInterface;

/**
 * Class AuthHandler
 * Handles successful authentication via Yii auth component
 * @package app\components
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * AuthHandler constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    protected function getUserData()
    {
        $attributes = $this->client->getUserAttributes();
        \Yii::trace(print_r($attributes, true));
        switch ($this->client->getId()) {
            case 'google':
                $email = ArrayHelper::getValue($attributes, 'emails')[0]['value'];
                $username = $email;
                $source_id = ArrayHelper::getValue($attributes, 'id');
                $nameArr = ArrayHelper::getValue($attributes, 'name');
                $name = $nameArr['givenName'];
                $surname = $nameArr['familyName'];
                break;
            case 'vkontakte':
                $email = ArrayHelper::getValue($attributes, 'screen_name') . '@example.com';
                $username = ArrayHelper::getValue($attributes, 'screen_name');
                $source_id = ArrayHelper::getValue($attributes, 'uid');
                $name = ArrayHelper::getValue($attributes, 'first_name');
                $surname = ArrayHelper::getValue($attributes, 'last_name');
                break;
            case 'facebook':
                $email = ArrayHelper::getValue($attributes, 'email');
                $username = $email;
                $source_id = ArrayHelper::getValue($attributes, 'id');
                $nameArr = ArrayHelper::getValue($attributes, 'name');
                $nameArr = explode(' ', $nameArr);
                $name = $nameArr[0];
                $surname = $nameArr[1];
        }
        return compact('username', 'email', 'source_id', 'name', 'surname');
    }

    /**
     * @throws \yii\base\Exception
     * @throws \yii\db\Exception
     */
    public function handle()
    {
        $userData = $this->getUserData();
        $auth = Auth::find()->where([
            'source' => $this->client->getId(),
            'source_id' => $userData['source_id'],
        ])->one();

        if (\Yii::$app->user->isGuest) {
            if ($auth) {
                $user = $auth->user;
                \Yii::$app->user->login(UserIdentity::findIdentity($user->id), \Yii::$app->params['user.rememberMeDuration']);
            } else {
                if ($userData['email'] !== null && UserRepository::find()->where(['email' => $userData['email']])->exists()) {
                    \Yii::$app->getSession()->setFlash('error', [
                        \Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.",
                            ['client' => $this->client->getTitle()]),
                    ]);
                } else {
                    $password = \Yii::$app->security->generateRandomString(6);
                    $user = new UserIdentity([
                        'username' => $userData['username'],
                        'email' => $userData['email'],
                        'password_hash' => \Yii::$app->security->generatePasswordHash($password),
                        'name' => $userData['name'],
                        'surname' => $userData['surname'],
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();

                    $transaction = UserRepository::getDb()->beginTransaction();

                    $userRec = new UserRepository($user);
                    if ($userRec->save()) {
                        $auth = new Auth([
                            'user_id' => $userRec->id,
                            'source' => $this->client->getId(),
                            'source_id' => (String)$userData['source_id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            $user->id = $userRec->id;
                            \Yii::$app->user->login($user, \Yii::$app->params['user.rememberMeDuration']);
                        } else {
                            \Yii::$app->getSession()->setFlash('error', [
                                \Yii::t('app', 'Unable to save {client} account: {errors}', [
                                    'client' => $this->client->getTitle(),
                                    'errors' => json_encode($auth->getErrors()),
                                ]),
                            ]);
                        }
                    } else {
                        \Yii::$app->getSession()->setFlash('error', [
                            \Yii::t('app', 'Unable to save {client}: {errors}', [
                                'client' => $this->client->getTitle(),
                                'errors' => json_encode($userRec->getErrors()),
                            ]),
                        ]);
                    }
                }
            }
            /**
             * user already logged in
             */
        } else {
            if (!$auth) {
                $auth = new Auth([
                    'user_id' => \Yii::$app->user->id,
                    'source' => $this->client->getId(),
                    'source_id' => (string)$userData['source_id'],
                ]);
                if ($auth->save()) {
                    \Yii::$app->getSession()->setFlash('success', [
                        \Yii::t('app', 'Linked {client} account.', [
                            'client' => $this->client->getTitle()
                        ]),
                    ]);
                } else {
                    \Yii::$app->getSession()->setFlash('error', [
                        \Yii::t('app', 'Unable to link {client} account: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ]),
                    ]);
                }
            } else {
                \Yii::$app->getSession()->setFlash('error', [
                    \Yii::t('app',
                        'Unable to link {client} account. There is another user using it.',
                        ['client' => $this->client->getTitle()]),
                ]);
            }
        }
    }
}