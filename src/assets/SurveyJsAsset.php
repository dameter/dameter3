<?php
declare(strict_types=1);

namespace respund\collector\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class SurveyJsAsset extends AssetBundle
{
    public $sourcePath = '@npm/survey-jquery';

    /**
     * @var string[]
     */
    public $css = [
        //'survey.css',
        //'modern.css',
        'defaultV2.css',
    ];

    /**
     * @var string[]
     */
    public $js = [
        'survey.jquery.js',
        'themes/layered-light.js'
    ];

    /**
     * @var string[]
     */
    public $depends = [
        \yii\web\JqueryAsset::class,
        ShowdownAsset::class,
    ];

}
