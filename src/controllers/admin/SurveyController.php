<?php

namespace respund\collector\controllers\admin;

use respund\collector\models\Survey;
use respund\collector\Translate;
use yii\base\UserException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii;

class SurveyController extends BaseAdminController
{
    public function actionIndex()
    {
        return "works";
    }
    public function actionUpdate()
    {

        $surveyKey = $this->request()->get('key');
        if(empty($surveyKey)) {
            throw new UserException("Invalid link");
        }
        $survey = (new Survey())->findByKey($surveyKey);
        if(!($survey instanceof $survey)) {
            throw new NotFoundHttpException();
        }

        if($this->request()->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = $this->request()->post();
            if($survey->load($post) && $survey->save()) {
                return ["saved"];
            } else {
                return ["errors" => $survey->errors];

            }

        }

        if($this->request()->isPost) {
            if($survey->load($this->request()->post())) {
                if ($survey->save()) {
                    // saved

                } else {
                    // Todo
                }
            }
        }


        $this->viewParams['survey'] = $survey;
        return $this->render('update', $this->viewParams);
    }

}