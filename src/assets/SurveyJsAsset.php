<?php
namespace dameter\app\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class SurveyJsAsset extends AssetBundle
{
    public $js = [
        'https://unpkg.com/survey-jquery/survey.jquery.min.js'
    ];

    public $css = [
        "https://unpkg.com/survey-jquery/defaultV2.min.css"
    ];
    public $depends = [
        \yii\web\JqueryAsset::class,
    ];

}
