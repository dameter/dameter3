<?php
declare(strict_types=1);

namespace respund\collector\controllers\api;
use respund\collector\factories\ResponseFactory;
use respund\collector\models\Respondent;
use respund\collector\models\Response;
use Yii;

class ResponseController extends BaseApiController
{
    public $enableCsrfValidation = false;

    public function beforeAction($action) : bool
    {
        Yii::info("API action:".$this->id."/".$this->action->id, __METHOD__);
        return parent::beforeAction($action);
    }


    /**
     * @return string[]
     */
    public function actionSave() : array
    {
        $request =  $this->request();
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

        if(!isset($data['responseId']) or empty($data['responseId'])) {
            $this->getApp()->warning("no-respondent",$data);
            return ["error"];
        }
        if(!isset($data['pageData']) or empty($data['pageData'])) {
            $this->getApp()->warning("no-pagedata", $data);
            return ["error"];
        }
        if(!isset($data['currentPageNo'])) {
            $this->getApp()->warning("no-pagenumber",$data);
            return ["error"];
        }

        $responseId = trim($data['responseId']);
        $response = (new Response())->findByUuid($responseId);
        if(!($response instanceof Response)) {
            $this->getApp()->warning("respose-not-found");
            return ["error"];
        }

        try {
            (new ResponseFactory())->saveData($response, $data);
        } catch ( \Exception $e) {
            //do not send to frontend, only log
            $this->getApp()->error("error saving response:".$e->getTraceAsString());
            return [""];
        }

        \Yii::info((string)json_encode($post), __METHOD__);
        return [""];
    }


    /**
     * @return string[]
     */
    public function actionLanguageChange() : array
    {
        return [""];
    }

}