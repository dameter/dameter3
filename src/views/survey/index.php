<?php

/** @var \yii\web\View $this */
/** @var Survey $survey */
/** @var Respondent $respondent */
/** @var Response $response */

use respund\collector\models\Respondent;
use respund\collector\models\Response;
use respund\collector\models\Survey;
use yii\helpers\Json;
use yii\helpers\Url;

\respund\collector\assets\LocalSurveyJsAsset::register($this);
$ip = Yii::$app->getRequest()->getUserIP();

$json = $survey->structure;
$url = Url::toRoute(["//api/response/save"]);
$responseId = $response->uuid;
$languageChangeUrl = Url::toRoute(["//api/response/language-change"]);
$pageNumber = $response->pageNumber();
$currentData = Json::encode($response->currentData());
$currentPageNo = Json::encode($response->pageNumber());

$this->registerJs(<<<JS
    let surveyJson =$json;
    const survey = new Survey.Model(surveyJson);
    survey.data = $currentData;
    
    survey.currentPageNo = $currentPageNo;
    // Instantiate Showdown
    const converter = new showdown.Converter();
    survey.onTextMarkdown.add(function (survey, options) {
        // Convert Markdown to HTML
        let str = converter.makeHtml(options.text);
        // Remove root paragraphs <p></p>
        str = str.substring(3);
        str = str.substring(0, str.length - 4);
        // Set HTML markup to render
        options.html = str;
    });

    
    
    survey.onAfterRenderSurvey.add(function (survey) {
        let languageChanger = document.getElementById('languageChanger');
        languageChanger.addEventListener('change',function(){
            survey.locale = this.value;
            let pageData = {["language"]: survey.locale};
            var postData = {
                currentPageNo: parseInt(survey.currentPageNo),
                pageData: pageData,
                responseId: '$responseId',
            };
            saveData('$languageChangeUrl', postData)
        });  
    });

    survey.onValueChanged.add(function (survey, options) {
        let variableName = options.name;
        let variableValue = options.value;
        let pageData = {[variableName]: variableValue};
        console.log(survey.currentPageNo);
        var postData = {
            currentPageNo: parseInt(survey.currentPageNo),
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
<select name="cars" id="languageChanger">
    <option value="et">Eesti</option>
    <option value="ru">Vene</option>
    <option value="en-US">English</option>
</select>
<div id="surveyContainer" ></div>
<div id="surveyResult" ></div>

