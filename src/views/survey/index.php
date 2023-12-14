<?php

/** @var \yii\web\View $this */
\dameter\app\assets\LocalSurveyJsAsset::register($this);
$surveyId = "test3";
$fileName = Yii::getAlias("@runtime")."/surveys/$surveyId.json";
$json = file_get_contents($fileName);
$url = \yii\helpers\Url::toRoute(["//api/response/save"]);
$responseId = rand(1000000,9999999);

$this->registerJs(<<<JS
    let surveyJson =$json;
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

