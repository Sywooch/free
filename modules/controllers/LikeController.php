<?php

namespace app\modules\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use app\filters\AuthorAccessRule;
use yii\data\ActiveDataProvider;
use app\modules\models\Like;

class LikeController extends ActiveController
{
    /**
     * @var string/
     */
    public $modelClass = 'app\modules\models\Like';


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
                    //@fixme: create Like query condition
                    'query' => is_null($travel_id) ?
                        Like::find() : Like::find()->withTravel($travel_id)
                ]);
            }
        ];
        return $actions;
    }

    /**
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result)
    {
        $isActionIndexAndRequestHasParamCount =
            ($action->id == 'index') && \Yii::$app->request->get('count');
        return parent::afterAction(
            $action,
            $isActionIndexAndRequestHasParamCount ?
                ['count' => $result->query->count()] : $result
        );
    }
}