<?php
namespace respund\collector\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class AppAsset extends AssetBundle
{
    public $sourcePath = __DIR__;

    public $css = [
        'css/style.css'
    ];

    public $js = [
        'js/app.js',
    ];

    public $depends = [
        \yii\bootstrap5\BootstrapAsset::class,
        YiiAsset::class
    ];
}
