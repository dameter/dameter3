<?php
declare(strict_types=1);

namespace respund\collector\assets;

use yii\web\AssetBundle;

/**
 * Class LocalSurveyJsAsset this contains the local customizations for the SurveyJs asset (which uses remote)
 */
class LocalSurveyJsAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__;

    /**
     * @var array<mixed>
     */
    public $publishOptions = [
        'forceCopy' => YII_ENV === 'dev',
    ];

    /**
     * @var string[]
     */
    public $css = [
        'css/my-surveyjs.css',
    ];

    /**
     * @var string[]
     */
    public $js = [
        'js/my-surveyjs.js',
    ];

    /**
     * @var string[]
     */
    public $depends = [
        SurveyJsAsset::class
    ];

}
