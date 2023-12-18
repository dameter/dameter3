<?php
namespace respund\collector\commands;

use respund\collector\models\Language;
use respund\collector\models\Respondent;
use respund\collector\models\Status;
use respund\collector\models\Survey;
use respund\collector\traits\ApplicationAwareTrait;
use Ramsey\Uuid\Uuid;
use yii\console\Controller;
use Yii;

class TestController extends Controller
{
    use ApplicationAwareTrait;

    public function actionCreateSurvey(string $surveyId) {

        // create survey entity from a json file

        $fileName = Yii::getAlias("@runtime")."/surveys/$surveyId.json";
        $json = file_get_contents($fileName);

        $survey = new Survey([
            'key' => $surveyId,
            'name' => $surveyId,
            'uuid' => Uuid::uuid4()->toString(),
            'structure' => $json,
            'status_id' => Status::CREATED
        ]);

        if(!$survey->save()) {
            $this->getApp()->error("error saving survey");
            print_r($survey->errors);
            return;
        }
        $this->getApp()->info("saved survey");


    }

    public function actionCreateRespondent(string $surveyKey, string $key) {

        $survey = (new Survey())->findByKey($surveyKey);
        $model = new Respondent([
            'key' => $key,
            'survey_id' => $survey->primaryKey,
            'uuid' => Uuid::uuid4()->toString(),
            'status_id' => Status::CREATED,
            'language_id' => Language::ESTONIAN
        ]);

        if(!$model->save()) {
            $this->getApp()->error("error saving model");
            print_r($model->errors);
            return;
        }
        $this->getApp()->info("saved model");
        print_r($model->attributes);


    }
}