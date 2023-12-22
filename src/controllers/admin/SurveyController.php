<?php
declare(strict_types=1);

namespace respund\collector\controllers\admin;

use respund\collector\models\Survey;
use respund\collector\models\SurveySearch;
use yii\base\UserException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii;

class SurveyController extends BaseAdminModelController
{

    protected $modelClass = Survey::class;
    protected $searchModelClass = SurveySearch::class;

    /**
     * @return array<mixed>|string
     * @throws NotFoundHttpException
     * @throws UserException
     * @throws \respund\collector\exceptions\RespundException
     */
    public function actionUpdate() : array|string
    {

        $surveyKey = $this->request()->get('key');
        if(empty($surveyKey) or (!is_string($surveyKey) and !is_numeric($surveyKey))) {
            throw new UserException("Invalid link");
        }


        $survey = $this->findSurvey($surveyKey);

        if($this->request()->isAjax) {
            $this->response()->format = Response::FORMAT_JSON;
            $post = $this->request()->post();
            if(!is_array($post)){
                return ["errors" => "invalid-post"];
            }
            if($survey->load($post) && $survey->save()) {
                return ["saved"];
            } else {
                return ["errors" => $survey->errors];

            }

        }

        if($this->request()->isPost) {
            $post = $this->request()->post();
            if(!is_array($post)){
                return ["errors" => "invalid-post"];
            }
            if($survey->load($post)) {
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