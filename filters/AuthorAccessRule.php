<?php

namespace app\filters;

use app\models\UserRepository;
use yii\filters\AccessRule;
use yii\web\NotFoundHttpException;

/**
 * Class AuthorAccessRule
 * @package app\filters
 */
class AuthorAccessRule extends AccessRule
{
    /**
     * @var bool allow access if this rule matches
     */
    public $allow = true;

    /**
     * @var array ensure user is logged in.
     */
    public $roles = ['@'];

    /**
     * @property string Action modelClass
     * @param \yii\Base\Action $action
     * Add a comment to this line
     * @param \yii\web\User $user
     * @param \yii\web\Request $request
     * @return bool|null
     */
    public function allows($action, $user, $request)
    {
        $parentRes = parent::allows($action, $user, $request);
        return $parentRes !== true ?
            $parentRes : ($this->getAuthorId($action->modelClass) == $user->id);
    }

    /**
     * Checks to the author.
     * @param UserRepository $modelClass
     * @property integer ActiveRecord user_id
     * @return null/
     */
    private function getAuthorId($modelClass)
    {
        $requestId = \Yii::$app->request->get('id');
        $author = $this->findModel($modelClass, $requestId);
        return isset($author) ? $author->user_id : null;
    }

    /**
     * @param \yii\db\ActiveRecord $modelClass
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException/
     */
    private function findModel($modelClass, $id)
    {
        $keys = $modelClass::primaryKey();
        if (count($keys) > 1) {
            $values = explode(',', $id);
            if (count($keys) === count($values)) {
                $model = $modelClass::findOne(array_combine($keys, $values));
            }
        } elseif ($id !== null) {
            $model = $modelClass::findOne($id);
        }
        return (isset($model)) ? $model : null;
    }
}
