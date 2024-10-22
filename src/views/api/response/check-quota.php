<?php
/** @var \respund\collector\app\View $this */
/** @var \respund\collector\models\Response $response */


use respund\collector\assets\LocalSurveyJsAsset;
use yii\helpers\Json;

$survey = $response->respondent->survey;
$json = $survey->structure;
$currentData = Json::encode($response->currentData());
$responseId = $response->uuid;
$resultUrl = \yii\helpers\Url::toRoute("//api/response/catch-quota-result");

LocalSurveyJsAsset::register($this);

$this->registerJs(<<<JS
    
          let surveyJson =$json;
          console.log("init survey")
          const surveyJs = new Survey.Model(surveyJson);
          console.log("init runner")
          const condition = "({source} = 1)";
          const runner = new Survey.ExpressionRunner(condition);
          console.log(condition);
          console.log("loading survey data")
          surveyJs.data = $currentData
          let result = runner.run(surveyJs.data);
          console.log("result following")
          console.log(result)

        let postData = {
            responseId: '$responseId',
            result: result
        };
        saveData('$resultUrl', postData)
    
JS
    , $this::POS_READY);
