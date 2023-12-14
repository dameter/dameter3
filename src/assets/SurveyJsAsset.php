<?php
namespace dameter\app\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class SurveyJsAsset extends AssetBundle
{
    public $sourcePath = '@npm/survey-jquery';

    public $css = [
        //'survey.css',
        //'modern.css',
        'defaultV2.css',
    ];

    public $js = [
        'survey.jquery.js',
        'themes/layered-light.js'
    ];

    public $depends = [
        \yii\web\JqueryAsset::class,
    ];

}
