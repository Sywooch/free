<?php

namespace app\controllers;

use app\models\TravelHasUser;
use app\models\search\TravelHasUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TravelHasUserController implements the CRUD actions for TravelHasUser model.
 */
class TravelHasUserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TravelHasUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TravelHasUserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TravelHasUser model.
     * @param string $travel_id
     * @param string $user_id
     * @return mixed
     */
    public function actionView($travel_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($travel_id, $user_id),
        ]);
    }

    /**
     * Creates a new TravelHasUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TravelHasUser();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'travel_id' => $model->travel_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TravelHasUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $travel_id
     * @param string $user_id
     * @return mixed
     */
    public function actionUpdate($travel_id, $user_id)
    {
        $model = $this->findModel($travel_id, $user_id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'travel_id' => $model->travel_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TravelHasUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $travel_id
     * @param string $user_id
     * @return mixed
     */
    public function actionDelete($travel_id, $user_id)
    {
        $this->findModel($travel_id, $user_id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the TravelHasUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $travel_id
     * @param string $user_id
     * @return TravelHasUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($travel_id, $user_id)
    {
        if (($model = TravelHasUser::findOne(['travel_id' => $travel_id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
