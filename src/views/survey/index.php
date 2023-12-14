<?php

/** @var \yii\web\View $this */
\dameter\app\assets\LocalSurveyJsAsset::register($this);
$surveyId = "test3";
$fileName = Yii::getAlias("@runtime")."/surveys/$surveyId.json";

$json = file_get_contents($fileName);
$this->registerJs(<<<JS
    let surveyJson =$json;
    const survey = new Survey.Model(surveyJson);
    
$(function() {
    $("#surveyContainer").Survey({ model: survey, onValueChanged: surveyValueChanged });
});


JS
    , $this::POS_READY);

?>

<div id="surveyContainer" ></div>
<div id="surveyResult" ></div>

