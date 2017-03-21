<?php

namespace app\modules;

/**
 * restapi module definition class
 */
class rest extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        \Yii::$app->user->enableSession = false;

        // custom initialization code goes here
    }
}
