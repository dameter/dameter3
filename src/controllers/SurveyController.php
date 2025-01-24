<?php

namespace respund\collector\controllers;

use respund\collector\exceptions\RespundException;
use respund\collector\factories\ResponseFactory;
use respund\collector\models\Respondent;
use respund\collector\models\Survey;
use yii\web\NotFoundHttpException;

class SurveyController extends BaseController
{
    public function actionIndex() : string
    {
        $request = $this->request();
        $key = $request->get('key');
        $model = $this->findSurvey($key);
        $this->viewParams['survey'] = $model;
        return $this->render('index', $this->viewParams);
    }

    public function actionRespondent() : string
    {
        $request = $this->request();
        $respondentKey = $request->get('key');
        $respondent = $this->findRespondent($respondentKey);

        $survey = $respondent->survey;
        $this->viewParams['survey'] = $survey;
        $this->viewParams['respondent'] = $respondent;
        $response = $respondent->response;
        if($response == null) {
            $response = (new ResponseFactory())->make($respondent, []);
        }
        $this->viewParams['response'] = $response;
        return $this->render('index', $this->viewParams);
    }

    public function actionTest() : string
    {
        return $this->render('test', $this->viewParams);

    }


}