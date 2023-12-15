<?php

/** @var \yii\web\View $this */
/** @var Survey $survey */
/** @var ?Respondent $respondent */

use dameter\app\models\Respondent;
use dameter\app\models\Survey;

\dameter\app\assets\LocalSurveyJsAsset::register($this);


$json = $survey->structure;
$respondentId = $respondent->uuid;
$url = \yii\helpers\Url::toRoute(["//api/response/save"]);
$responseId = rand(1000000,9999999);

$this->registerJs(<<<JS
    let surveyJson =$json;
    let respondentUuid ='$respondentId';
    const survey = new Survey.Model(surveyJson);
    survey.applyTheme(SurveyTheme.LayeredLight);
    
    survey.onValueChanged
    .add(function (survey, options) {
        let variableName = options.name;
        let variableValue = options.value;
        let pageData = {[variableName]: variableValue};
        var postData = {
            pageData: pageData,
            responseId: '$responseId',
            respondent: respondentUuid,
        };
        
        document
        .textContent = JSON.stringify(pageData);
        saveData('$url', postData)
    });

$(function() {
    $("#surveyContainer").Survey({ model: survey, onValueChanged: surveyValueChanged });
});


JS
    , $this::POS_READY);

?>

<div id="surveyContainer" ></div>
<div id="surveyResult" ></div>

