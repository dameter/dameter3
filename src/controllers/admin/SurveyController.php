<?php

namespace respund\collector\controllers\admin;

use respund\collector\models\Survey;
use yii\base\UserException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii;

class SurveyController extends BaseAdminController
{
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
                return $this->request()->post();
                return ["errors" => $survey->errors];

            }

        }

        if($this->request()->isPost) {
            var_dump($this->request()->post());die;
            if($survey->load($this->request()->post()) && $survey->save()) {

                // saved
            }
        }


        $this->viewParams['survey'] = $survey;
        return $this->render('update', $this->viewParams);
    }

}