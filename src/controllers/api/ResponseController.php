<?php

namespace dameter\app\controllers\api;
use dameter\app\factories\ResponseFactory;
use dameter\app\models\Respondent;
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
        if(!isset($post['data']) or empty($post['data'])) {
            $this->getApp()->warning("no-data");
            return ["error"];
        }
        $data = $post['data'];

        if(!isset($data['respondent']) or empty($data['respondent'])) {
            $this->getApp()->warning("no-respondent");
            return ["error"];
        }
        if(!isset($data['pageData']) or empty($data['pageData'])) {
            $this->getApp()->warning("no-pagedata");
            return ["error"];
        }

        $respondentId = trim($data['respondent']);
        $respondent = (new Respondent())->findByUuid($respondentId);
        if(!($respondent instanceof Respondent)) {
            $this->getApp()->warning("respondent-not-found");
            return ["error"];
        }

        $response = (new ResponseFactory())->make($respondent, $data['pageData']);

        \Yii::info(json_encode($respondent->attributes), __METHOD__);
        \Yii::info(json_encode($post), __METHOD__);
        return ["kjsdfbsdfjk"];
    }

}