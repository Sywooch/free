<?php

namespace app\controllers;

use app\models\RegistrationForm;
use app\models\UserRepository;
use yii\web\Controller;

class RegistrationController extends Controller
{

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionIndex()
    {
        $model = new RegistrationForm();
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                if (!UserRepository::findOne(['username' => $model->username])) {
                    $modelUser = new UserRepository();
                    $modelUser->username = $model->username;
                    $modelUser->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($model->password);
                    $modelUser->email = $model->email;
                    $modelUser->save();
                    return $this->render('success');
                }
                return $this->render('error', ['model' => $model]);
            }
        }
        return $this->render('index', ['model' => $model]);
    }
}