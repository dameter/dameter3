<?php
namespace dameter\app\commands;

use dameter\app\models\Status;
use dameter\app\models\Survey;
use dameter\app\traits\ApplicationAwareTrait;
use Ramsey\Uuid\Uuid;
use yii\console\Controller;
use Yii;

class TestController extends Controller
{
    use ApplicationAwareTrait;

    public function actionCreateSurvey(string $surveyId) {
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
        print_r($survey->attributes);


    }
}