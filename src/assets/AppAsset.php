<?php
declare(strict_types=1);

namespace respund\collector\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class AppAsset extends AssetBundle
{
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
        'css/style.css'
    ];

    /**
     * @var string[]
     */
    public $js = [
        'js/app.js',
    ];

    /**
     * @var string[]
     */
    public $depends = [
        YiiAsset::class,
        \yii\bootstrap5\BootstrapAsset::class,
    ];
}
