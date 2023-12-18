<?php
namespace respund\collector\assets;

use yii\web\AssetBundle;

/**
 * Class LocalSurveyJsAsset this contains the local customizations for the SurveyJs asset (which uses remote)
 */
class LocalSurveyJsAsset extends AssetBundle
{
    public $sourcePath = __DIR__;
    public $publishOptions = [
        'forceCopy' => YII_ENV === 'dev',
    ];

    public $css = [
        'css/my-surveyjs.css',
    ];

    public $js = [
        'js/my-surveyjs.js',
    ];

    public $depends = [
        SurveyJsAsset::class
    ];

}
