<?php
declare(strict_types=1);

namespace respund\collector\controllers\api;

use respund\collector\assets\LocalSurveyJsAsset;
use respund\collector\exceptions\RespundException;
use respund\collector\factories\ResponseFactory;
use respund\collector\models\Response;
use Yii;
use yii\helpers\Json;

class ResponseController extends BaseApiController
{
    public $enableCsrfValidation = false;

    public function beforeAction($action): bool
    {
        if ($this->action === null) {
            throw new RespundException("Action missing");
        }
        Yii::info("API action:" . $this->id . "/" . $this->action->id, __METHOD__);
        return parent::beforeAction($action);
    }


    /**
     * @return string[]
     */
    public function actionSave(): array
    {
        $request = $this->request();
        if (!$request->getIsPost()) {
            Yii::info("no data", __METHOD__);
            return ["no-data"];
        }
        $post = $request->post();
        if (!is_array($post) or !isset($post['data']) or empty($post['data'])) {
            $this->getApp()->warning("no-data");
            return ["error"];
        }
        $data = $post['data'];

        if (!isset($data['responseId']) or empty($data['responseId'])) {
            $this->getApp()->warning("no-respondent", $data);
            return ["error"];
        }
        if (!isset($data['pageData']) or empty($data['pageData'])) {
            $this->getApp()->warning("no-pagedata", $data);
            return ["error"];
        }
        if (!isset($data['currentPageNo'])) {
            $this->getApp()->warning("no-pagenumber", $data);
            return ["error"];
        }

        $responseId = trim($data['responseId']);
        $response = (new Response())->findByUuid($responseId);
        if (!($response instanceof Response)) {
            $this->getApp()->warning("respose-not-found");
            return ["error"];
        }

        try {
            (new ResponseFactory())->saveData($response, $data);
        } catch (\Exception $e) {
            //do not send to frontend, only log
            $this->getApp()->error("error saving response:" . $e->getTraceAsString());
            return [""];
        }

        \Yii::info((string)json_encode($post), __METHOD__);
        return [""];
    }


    public function actionCheckQuota(): string
    {
        $this->response()->format = \yii\web\Response::FORMAT_HTML;
        /** @var ?Response $response */
        $response = (new Response())->findByUuid($this->request()->get('responseId'));

        if ($response === null) {
            return "";
        }
        $logContext = ['response' => $response->uuid];
        $this->getApp()->info("checkQuota", $logContext);
        return $this->render('check-quota', ['response' => $response]);
    }

    public function actionCatchQuotaResult()
    {
        $response = $this->findResponse();
        if ($response === null) {
            return [];
        }
        $logContext = ['response' => $response->uuid, 'result' => $this->request()->post()];
        $this->getApp()->info("catchQuotaResult", $logContext);

    }


    /**
     * @return string[]
     */
    public function actionLanguageChange(): array
    {
        return [""];
    }





    private function findResponse(): ?Response
    {
        $request = $this->request();
        if (!$request->getIsPost()) {
            $this->getApp()->warning("no-data");
            return null;
        }
        $post = $request->post();
        if (!is_array($post) or !isset($post['data']) or empty($post['data'])) {
            $this->getApp()->warning("no-data");
            return null;
        }
        $data = $post['data'];

        if (!isset($data['responseId']) or empty($data['responseId'])) {
            $this->getApp()->warning("no-respondent", $data);
            return null;
        }
        $responseId = trim($data['responseId']);
        /** @var ?Response $response */
        $response = (new Response())->findByUuid($responseId);
        return $response;

    }


}
