<?php

namespace dameter\app\controllers\api;
use Yii;

class ResponseController extends BaseApiController
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        Yii::info("API action:".$this->id."/".$this->action->id, __METHOD__);
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        Yii::info("post data", __METHOD__);
        return ["kjsdfbsdfjk"];
    }

    public function actionSave()
    {
        $request = \Yii::$app->request;
        if(!$request->getIsPost()) {
            Yii::info("no data", __METHOD__);
            return ["no-data"];
        }
        $post = $request->post();

        \Yii::info(json_encode($post), __METHOD__);
        return ["kjsdfbsdfjk"];
    }

}