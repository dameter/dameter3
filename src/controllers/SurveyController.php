<?php

namespace dameter\app\controllers;

use dameter\app\models\Respondent;
use dameter\app\models\Survey;
use yii\web\NotFoundHttpException;

class SurveyController extends BaseController
{
    public function actionIndex() {
        $request = $this->request();
        $key = $request->get('key');
        $model = (new Survey())->findByKey($key);
        $this->viewParams['model'] = $model;
        return $this->render('index', $this->viewParams);
    }

    public function actionRespondent()
    {
        $request = $this->request();
        $respondentKey = $request->get('key');
        $respondent = (new Respondent())->findByKey($respondentKey);
        if(!($respondent instanceof Respondent)) {
            throw new NotFoundHttpException();
        }
        $survey = $respondent->survey;
        $this->viewParams['survey'] = $survey;
        $this->viewParams['respondent'] = $respondent;
        return $this->render('index', $this->viewParams);
    }

}