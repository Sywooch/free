<?php

namespace app\modules\controllers;

use app\modules\models\Post;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use app\filters\AuthorAccessRule;
use yii\data\ActiveDataProvider;

class PostController extends ActiveController
{
    /**
     * @var string/
     */
    public $modelClass = 'app\modules\models\Post';

    /**  Adding authentication to the controller.
     *  Adding checks to the author.
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['create', 'update', 'delete']
        ];
        $behaviors['authorAccess'] = [
            'class' => AccessControl::className(),
            'only' => ['update', 'delete'],
            'rules' => [
                [
                    'class' => AuthorAccessRule::className(),
                    'actions' => ['update', 'delete']
                ]
            ]
        ];
        return $behaviors;
    }

    /** /
     * redefinition Action Index
     * @return mixed
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
                    //@fixme query condition
                    'query' => is_null($travel_id) ?
                        Post::find() : Post::find()->withTravel($travel_id)
                ]);
            }
        ];
        return $actions;
    }
}