<?php

namespace app\modules\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use app\filters\AuthorAccessRule;
use app\modules\models\TravelUser;
use yii\data\ActiveDataProvider;

class TravelUserController extends ActiveController
{
    /**
     * @var string/
     */
    public $modelClass = 'app\modules\models\TravelUser';

    /**  Adding authentication to the controller.
     *  Adding checks to the author.
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['create', 'delete']
        ];
        $behaviors['authorAccess'] = [
            'class' => AccessControl::className(),
            'only' => ['delete'],
            'rules' => [
                [
                    'class' => AuthorAccessRule::className(),
                    'actions' => ['delete']
                ]
            ]
        ];
        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'prepareDataProvider' => function () {
                $travel_id = \Yii::$app->request->get('travel_id');
                return new ActiveDataProvider([
                    'query' => is_null($travel_id) ?
                        TravelUser::find() : TravelUser::find()->withTravel($travel_id)
                ]);
            }
        ];
        return $actions;
    }
}
